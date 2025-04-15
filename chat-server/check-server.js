#!/usr/bin/env node

/**
 * Socket.IO Server Status Check Script
 * 
 * This script checks if the Socket.IO server is running properly
 * and can establish connections. It also validates CORS settings.
 */
const { io } = require('socket.io-client');
const https = require('https');
const http = require('http');

// Configuration
const SERVER_URL = 'https://chat.takashimayavn.com';
const TIMEOUT = 10000;
const DEBUG = true;

console.log(`Socket.IO Server Status Check`);
console.log(`Testing server at: ${SERVER_URL}`);

// First check HTTP/HTTPS status
const protocol = SERVER_URL.startsWith('https') ? https : http;
const healthUrl = `${SERVER_URL}/health`;

console.log(`\n1. Checking server health endpoint: ${healthUrl}`);
protocol.get(healthUrl, (res) => {
    let data = '';
    
    res.on('data', (chunk) => {
        data += chunk;
    });
    
    res.on('end', () => {
        console.log(`   HTTP Status: ${res.statusCode} ${res.statusMessage}`);
        console.log(`   Headers:`);
        console.log(`   ${JSON.stringify(res.headers, null, 2)}`);
        
        try {
            const healthData = JSON.parse(data);
            console.log(`   Health check response: ${JSON.stringify(healthData, null, 2)}`);
            
            if (healthData.status === 'ok') {
                console.log(`   ✅ Server health check: OK`);
                console.log(`   Connected users: ${healthData.connections?.users?.length || 0}`);
                console.log(`   Connected sellers: ${healthData.connections?.sellers?.length || 0}`);
            } else {
                console.log(`   ❌ Server health check: FAIL - ${healthData.message}`);
            }
        } catch (e) {
            console.log(`   ❌ Error parsing health check response: ${e.message}`);
            console.log(`   Response data: ${data}`);
        }
        
        // Now test Socket.IO connection
        testSocketConnection();
    });
}).on('error', (err) => {
    console.log(`   ❌ HTTP request error: ${err.message}`);
    // Continue to socket check anyway
    testSocketConnection();
});

function testSocketConnection() {
    console.log(`\n2. Testing Socket.IO connection`);
    
    const socketOptions = {
        reconnectionAttempts: 3,
        reconnectionDelay: 1000,
        timeout: TIMEOUT,
        transports: ['websocket', 'polling'],
        forceNew: true,
        debug: DEBUG
    };
    
    console.log(`   Connecting with options: ${JSON.stringify(socketOptions, null, 2)}`);
    const socket = io(SERVER_URL, socketOptions);
    
    let connected = false;
    let timer = setTimeout(() => {
        if (!connected) {
            console.log(`   ❌ Connection timeout after ${TIMEOUT}ms`);
            socket.disconnect();
            process.exit(1);
        }
    }, TIMEOUT);
    
    socket.on('connect', () => {
        connected = true;
        clearTimeout(timer);
        console.log(`   ✅ Socket.IO connected successfully! Socket ID: ${socket.id}`);
        console.log(`   Transport used: ${socket.io.engine.transport.name}`);
        console.log(`   Protocol: ${socket.io.engine.transport.ws ? 'WebSocket' : 'HTTP long-polling'}`);
        
        // Try to authenticate
        console.log(`\n3. Testing authentication`);
        socket.emit('authenticate', { type: 'user', userId: 999 });
        
        // Wait for response or timeout
        setTimeout(() => {
            console.log(`   No explicit authentication response received`);
            testDisconnect(socket);
        }, 3000);
    });
    
    socket.on('auth_success', (data) => {
        console.log(`   ✅ Authentication success: ${JSON.stringify(data)}`);
        testDisconnect(socket);
    });
    
    socket.on('error', (error) => {
        console.log(`   ❌ Socket error: ${error}`);
    });
    
    socket.on('connect_error', (error) => {
        console.log(`   ❌ Connection error: ${error.message}`);
        console.log(`   Stack: ${error.stack}`);
    });
}

function testDisconnect(socket) {
    console.log(`\n4. Testing disconnect`);
    socket.disconnect();
    console.log(`   Socket manually disconnected`);
    console.log(`\nTest completed. Check the results above.`);
    console.log(`If HTTP health check succeeded but Socket.IO connection failed, check:`);
    console.log(`- Network/firewall settings (port access, WebSocket protocol)`);
    console.log(`- Socket.IO server configuration (CORS, transport settings)`);
    console.log(`- SSL certificate validity for secure WebSocket (wss://)`);
    process.exit(0);
}