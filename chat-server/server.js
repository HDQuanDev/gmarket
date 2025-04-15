const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql2/promise');
const cors = require('cors');
require('dotenv').config();

const app = express();

// Enhanced CORS configuration with detailed options
app.use(cors({
  origin: ["https://takashimayavn.com", "https://www.takashimayavn.com", "*"],
  methods: ["GET", "POST", "OPTIONS"],
  credentials: true,
  allowedHeaders: ["Content-Type", "Authorization"]
}));

const server = http.createServer(app);

// Improved Socket.IO configuration with detailed error logging
const io = socketIo(server, {
  cors: {
    origin: ["https://takashimayavn.com", "https://www.takashimayavn.com", "*"],
    methods: ["GET", "POST", "OPTIONS"],
    credentials: true,
    allowedHeaders: ["Content-Type", "Authorization"]
  },
  pingTimeout: 60000,
  pingInterval: 25000,
  transports: ['websocket', 'polling'],
  path: '/socket.io',
  maxHttpBufferSize: 1e6, // 1MB
  connectTimeout: 45000 // Increased timeout for high-latency connections
});

// Debug middleware for connection tracking
io.use((socket, next) => {
  console.log(`Connection attempt from ${socket.handshake.address} via ${socket.handshake.headers['user-agent']}`);
  console.log(`Transport: ${socket.conn.transport.name}`);
  next();
});

// MySQL connection pool with improved error handling
const pool = mysql.createPool({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'gmarket',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Test database connection on startup
(async () => {
  try {
    const connection = await pool.getConnection();
    console.log('Database connection successful');
    connection.release();
  } catch (err) {
    console.error('Error connecting to database:', err);
  }
})();

// Online users tracking
const onlineUsers = new Map(); // userId -> socketId
const onlineSellers = new Map(); // sellerId -> socketId

// Socket.io connection handler
io.on('connection', async (socket) => {
  console.log('New client connected', socket.id);
  
  // User authentication
  socket.on('authenticate', async (data) => {
    console.log('Authentication request:', data);
    
    try {
      if (!data) {
        throw new Error('No authentication data provided');
      }
      
      if (data.type === 'user' && data.userId) {
        onlineUsers.set(data.userId.toString(), socket.id);
        socket.userId = data.userId;
        socket.userType = 'user';
        console.log(`User ${data.userId} authenticated`);
        
        // Mark messages as read when user connects
        try {
          await markMessagesAsRead('user', data.userId);
        } catch (err) {
          console.error('Error marking messages as read:', err);
        }
      } 
      else if (data.type === 'seller' && data.sellerId) {
        onlineSellers.set(data.sellerId.toString(), socket.id);
        socket.sellerId = data.sellerId;
        socket.userType = 'seller';
        console.log(`Seller ${data.sellerId} authenticated`);
        
        // Mark messages as read when seller connects
        try {
          await markMessagesAsRead('seller', data.sellerId);
        } catch (err) {
          console.error('Error marking messages as read:', err);
        }
      } else {
        throw new Error('Invalid authentication data');
      }
      
      // Send success response
      socket.emit('auth_success', { success: true });
      
    } catch (err) {
      console.error('Authentication error:', err);
      socket.emit('error', { message: 'Authentication failed: ' + err.message });
    }
  });

  // Handle new messages with improved validation and error handling
  socket.on('send_message', async (messageData) => {
    console.log('Received message data:', messageData);
    
    try {
      // Validate messageData
      const { conversationId, senderType, senderId, message, attachmentUrl } = messageData;
      
      if (!conversationId || !senderType || !senderId) {
        throw new Error('Invalid message data: missing required fields');
      }
      
      if (message && typeof message !== 'string') {
        throw new Error('Message must be a string');
      }
      
      if (message && (message.trim().length === 0 || message.length > 5000)) {
        throw new Error('Message length must be between 1 and 5000 characters');
      }
      
      // Allow empty message only if attachment is present
      if (!message && !attachmentUrl) {
        throw new Error('Message or attachment is required');
      }
      
      // Validate that the sender is authenticated correctly
      if ((senderType === 'user' && socket.userId != senderId) || 
          (senderType === 'seller' && socket.sellerId != senderId)) {
        throw new Error('Sender authentication mismatch');
      }
      
      // Ensure sender_type is exactly 'user' or 'seller' (not uppercase, not with spaces)
      const validatedSenderType = senderType.toLowerCase().trim() === 'seller' ? 'seller' : 'user';
      
      // Store message in database
      const connection = await pool.getConnection();
      try {
        await connection.beginTransaction();
        
        // Fix: Change attachment_url to attachment in the SQL query
        const [result] = await connection.execute(
          `INSERT INTO chat_messages 
          (conversation_id, sender_type, sender_id, message, attachment, is_read, created_at) 
          VALUES (?, ?, ?, ?, ?, 0, NOW())`,
          [conversationId, validatedSenderType, senderId, message || '', attachmentUrl || null]
        );
        
        // Get conversation details to notify the recipient
        const [conversations] = await connection.execute(
          `SELECT user_id, seller_id FROM chat_conversations WHERE id = ?`,
          [conversationId]
        );
        
        // Get the newly created message with timestamp
        const [messages] = await connection.execute(
          `SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as formatted_time 
           FROM chat_messages WHERE id = ?`,
          [result.insertId]
        );
        
        await connection.commit();
        connection.release();
        
        if (conversations.length === 0) {
          throw new Error(`Conversation with ID ${conversationId} not found`);
        }
        
        if (messages.length === 0) {
          throw new Error(`Message insertion failed`);
        }
        
        const conversation = conversations[0];
        const messageWithTime = messages[0];
        
        // Determine recipient
        const recipientType = senderType === 'user' ? 'seller' : 'user';
        const recipientId = senderType === 'user' ? conversation.seller_id : conversation.user_id;
        
        // Check if recipient is online
        const recipientSocketId = recipientType === 'user' 
          ? onlineUsers.get(recipientId.toString())
          : onlineSellers.get(recipientId.toString());
        
        console.log(`Recipient ${recipientType} ${recipientId} socket ID: ${recipientSocketId || 'offline'}`);
        
        // Create notification for offline recipient
        if (!recipientSocketId) {
          await createNotification(recipientId, recipientType, conversationId, senderType, senderId);
        }
        
        // Broadcast to recipient if online
        if (recipientSocketId) {
          io.to(recipientSocketId).emit('new_message', {
            ...messageWithTime,
            conversation_id: conversationId
          });
        }
        
        // Send back confirmation to sender
        socket.emit('message_sent', {
          ...messageWithTime,
          conversation_id: conversationId
        });
        
        console.log(`Message sent successfully: ID ${result.insertId}`);
        
      } catch (err) {
        console.error('Database error:', err);
        await connection.rollback();
        connection.release();
        socket.emit('error', { message: 'Failed to send message: ' + err.message });
      }
    } catch (err) {
      console.error('Error sending message:', err);
      socket.emit('error', { message: err.message || 'Server error' });
    }
  });

  // Mark messages as read
  socket.on('mark_read', async (data) => {
    try {
      const { conversationId, readerType, readerId } = data;
      
      if (!conversationId || !readerType || !readerId) {
        socket.emit('error', { message: 'Invalid data for marking messages read' });
        return;
      }
      
      const connection = await pool.getConnection();
      try {
        // Mark messages as read where the reader is not the sender
        await connection.execute(
          `UPDATE chat_messages 
           SET is_read = 1 
           WHERE conversation_id = ? AND sender_type != ? AND sender_id != ?`,
          [conversationId, readerType, readerId]
        );
        
        connection.release();
        
        // Notify the other party that messages were read
        const [conversations] = await pool.execute(
          `SELECT user_id, seller_id FROM chat_conversations WHERE id = ?`,
          [conversationId]
        );
        
        if (conversations.length > 0) {
          const conversation = conversations[0];
          const otherPartyType = readerType === 'user' ? 'seller' : 'user';
          const otherPartyId = readerType === 'user' ? conversation.seller_id : conversation.user_id;
          
          // Find the socket ID of the other party
          const otherPartySocketId = otherPartyType === 'user' 
            ? onlineUsers.get(otherPartyId.toString())
            : onlineSellers.get(otherPartyId.toString());
          
          if (otherPartySocketId) {
            io.to(otherPartySocketId).emit('messages_read', {
              conversation_id: conversationId,
              reader_type: readerType,
              reader_id: readerId
            });
          }
        }
      } catch (err) {
        console.error('Database error marking messages read:', err);
        connection.release();
      }
    } catch (err) {
      console.error('Error marking messages read:', err);
    }
  });

  // Typing indicator
  socket.on('typing', (data) => {
    const { conversationId, userType, userId } = data;
    
    if (conversationId && userType && userId) {
      socket.to(getRecipientRoom(conversationId, userType, userId)).emit('typing_indicator', {
        conversation_id: conversationId,
        user_type: userType,
        user_id: userId,
        typing: true
      });
    }
  });

  socket.on('stop_typing', (data) => {
    const { conversationId, userType, userId } = data;
    
    if (conversationId && userType && userId) {
      socket.to(getRecipientRoom(conversationId, userType, userId)).emit('typing_indicator', {
        conversation_id: conversationId,
        user_type: userType,
        user_id: userId,
        typing: false
      });
    }
  });

  // Disconnect handler
  socket.on('disconnect', () => {
    console.log('Client disconnected', socket.id);
    if (socket.userType === 'user' && socket.userId) {
      onlineUsers.delete(socket.userId);
    } else if (socket.userType === 'seller' && socket.sellerId) {
      onlineSellers.delete(socket.sellerId);
    }
  });
});

// Helper function to get recipient room
function getRecipientRoom(conversationId, senderType, senderId) {
  // In a real implementation, you would look up the conversation to find the recipient
  // For simplicity, we're just returning the conversation ID as the room
  return `conversation_${conversationId}`;
}

// Helper function to mark messages as read
async function markMessagesAsRead(readerType, readerId) {
  try {
    const connection = await pool.getConnection();
    
    // Find conversations for this user/seller
    const [conversations] = await connection.execute(
      `SELECT id FROM chat_conversations WHERE ${readerType}_id = ?`,
      [readerId]
    );
    
    // Mark messages in these conversations as read where the reader is not the sender
    for (const conversation of conversations) {
      await connection.execute(
        `UPDATE chat_messages 
         SET is_read = 1 
         WHERE conversation_id = ? AND sender_type != ? AND sender_id != ?`,
        [conversation.id, readerType, readerId]
      );
    }
    
    connection.release();
  } catch (err) {
    console.error('Error marking messages read on connect:', err);
    throw err;
  }
}

// Helper function to create notifications
async function createNotification(receiverId, receiverType, conversationId, senderType, senderId) {
  try {
    // Get sender name (either user or seller)
    const connection = await pool.getConnection();
    
    let senderName = 'Someone';
    if (senderType === 'user') {
      const [users] = await connection.execute('SELECT full_name FROM users WHERE id = ?', [senderId]);
      if (users.length > 0) {
        senderName = users[0].full_name;
      }
    } else {
      const [sellers] = await connection.execute('SELECT full_name FROM sellers WHERE id = ?', [senderId]);
      if (sellers.length > 0) {
        senderName = sellers[0].full_name;
      }
    }
    
    // Create notification
    await connection.execute(
      `INSERT INTO notifications 
      (receiver_id, receiver_type, type, title, content, reference_id, is_read, created_at) 
      VALUES (?, ?, 'chat_message', ?, ?, ?, 0, NOW())`,
      [
        receiverId, 
        receiverType, 
        `New message from ${senderName}`,
        `You have received a new message.`,
        conversationId
      ]
    );
    
    connection.release();
  } catch (err) {
    console.error('Error creating notification:', err);
  }
}

// Health check endpoint with more diagnostics
app.get('/health', async (req, res) => {
  try {
    // Test database connection
    const connection = await pool.getConnection();
    connection.release();
    
    res.json({ 
      status: 'ok', 
      connections: { 
        users: Array.from(onlineUsers.keys()), 
        sellers: Array.from(onlineSellers.keys()),
        count: {
          users: onlineUsers.size,
          sellers: onlineSellers.size,
          total: onlineUsers.size + onlineSellers.size
        }
      },
      server: {
        uptime: Math.floor(process.uptime()),
        memory: process.memoryUsage(),
        nodeVersion: process.version
      }
    });
  } catch (err) {
    res.status(500).json({ 
      status: 'error', 
      message: err.message,
      connections: {
        users: onlineUsers.size,
        sellers: onlineSellers.size
      }
    });
  }
});

// Start server
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Chat server running on port ${PORT}`);
});
