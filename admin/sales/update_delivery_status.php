<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo json_encode(['status' => 0, 'message' => 'Unauthorized access']);
    exit;
}

if(isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    // If trying to set status to Delivered, check if it's already delivered to prevent duplicate actions
    if($status == "Delivered") {
        $check_order = fetch_array("SELECT delivery_status FROM orders WHERE id='$order_id' LIMIT 1");
        
        // If order is already marked as delivered, return success but don't do anything
        if($check_order && $check_order['delivery_status'] == "Delivered") {
            echo json_encode(['status' => 1, 'message' => 'Order already marked as delivered']);
            exit;
        }
        
        // Also check if commission is already recorded for this order
        $check_commission = fetch_array("SELECT id FROM commission_history WHERE order_id='$order_id' LIMIT 1");
        if($check_commission) {
            // Commission already recorded, just update the status
            $update = mysqli_query($conn, "UPDATE orders SET delivery_status='$status' WHERE id='$order_id'");
            if($update) {
                echo json_encode(['status' => 1, 'message' => 'Delivery status updated, commission already recorded']);
            } else {
                echo json_encode(['status' => 0, 'message' => 'Failed to update delivery status']);
            }
            exit;
        }
    }
    
    // Begin transaction to ensure data integrity
    mysqli_begin_transaction($conn);
    
    try {
        $update = mysqli_query($conn, "UPDATE orders SET delivery_status='$status' WHERE id='$order_id'");
        $transaction_details = [];
        
        if($update) {
            // If status is Delivered, add commission records
            if($status == "Delivered") {
                // Get seller settings for commission rate
                $seller_setting = fetch_array("SELECT * FROM seller_setting WHERE id=1 LIMIT 1");
                $commission_rate = $seller_setting['commission'];
                $transaction_details['commission_rate'] = $commission_rate;
                
                // Get order details
                $order = fetch_array("SELECT * FROM orders WHERE id='$order_id' LIMIT 1");
                $transaction_details['order_info'] = $order;
                
                // Get all order items from detail_orders
                $sql = mysqli_query($conn, "SELECT * FROM detail_orders WHERE order_id='$order_id' AND from_seller > 0");
                $has_commission_entries = false;
                $transaction_details['items'] = [];
                
                while($item = fetch_assoc($sql)) {
                    $seller_id = $item['from_seller'];
                    
                    // Calculate item total price (original amount without commission)
                    $total_amount = $item['price'] * $item['quantity'];
                    
                    // Calculate commission amount (what admin earns)
                    $commission_amount = $total_amount * ($commission_rate / 100);
                    
                    // Seller's earning from this item (original amount PLUS commission)
                    $earning = $total_amount + $commission_amount;
                    
                    // Get seller's current balance
                    $seller = fetch_array("SELECT money FROM sellers WHERE id='$seller_id' LIMIT 1");
                    $previous_balance = $seller['money'];
                    
                    // New balance is previous balance plus earnings
                    if($order['payment_option'] == "cash_on_delivery") {
                         $current_balance = $previous_balance + $earning;
                    }else {
                         $current_balance = $previous_balance + $commission_amount;
                    }
                   
                    
                    // Update seller balance with the new amount
                    mysqli_query($conn, "UPDATE sellers SET money = '$current_balance' WHERE id='$seller_id'");
                    
                    // Insert into commission_history
                    $insert = mysqli_query($conn, "INSERT INTO commission_history (order_id, order_code, seller_id, admin_commission, seller_earning, previous_balance, current_balance, created_at) 
                                         VALUES ('$order_id', '{$order['code']}', '$seller_id', '$commission_amount', '$earning', '$previous_balance', '$current_balance', NOW())");
                    
                    if($insert) {
                        $has_commission_entries = true;
                    }
                    
                    // Add transaction details for this item
                    $transaction_details['items'][] = [
                        'item_id' => $item['id'],
                        'seller_id' => $seller_id,
                        'product_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total_amount' => $total_amount,
                        'commission_amount' => $commission_amount,
                        'seller_earning' => $earning,
                        'previous_balance' => $previous_balance,
                        'current_balance' => $current_balance
                    ];
                }
                
                // Record log for tracking
                $admin_id = $_SESSION['admin_id'] ?? 0;
                mysqli_query($conn, "INSERT INTO order_status_log (order_id, status, changed_by, admin_id, created_at) 
                             VALUES ('$order_id', 'Delivered', 'admin', '$admin_id', NOW())");
                
                $transaction_details['admin_id'] = $admin_id;
            }
            
            // Commit transaction
            mysqli_commit($conn);
            echo json_encode(['status' => 1, 'message' => 'Order status updated successfully', 'details' => $transaction_details]);
        } else {
            // Rollback on error
            mysqli_rollback($conn);
            echo json_encode(['status' => 0, 'message' => 'Failed to update order status']);
        }
    } catch (Exception $e) {
        // Rollback on exception
        mysqli_rollback($conn);
        echo json_encode(['status' => 0, 'message' => 'Exception: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 0, 'message' => 'Missing required parameters']);
}
?>