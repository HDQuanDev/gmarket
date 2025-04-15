<?php 
require_once(__DIR__ . "/../config.php");
if (!$isLogin) header("Location: /users/login");

// Get user's order history from database
$orders_query = "SELECT o.*, 
                (SELECT COUNT(id) FROM detail_orders WHERE order_id = o.id) as total_items
                FROM orders o
                WHERE o.user_id = ? 
                ORDER BY o.create_date DESC";
$stmt = $conn->prepare($orders_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();

// Include header
require_once(__DIR__ . "/../layout/header.php");
?>

<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start">
            <div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
                <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
                    <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">
                        <span class="avatar avatar-md mb-3">
                            <img src="https://tmdtquocte.com/public/assets/img/avatar-place.png" class="image rounded-circle"
                                onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/avatar-place.png';">
                        </span>
                        <h4 class="h5 fs-16 mb-1 fw-600"><?= $user_name ?></h4>
                        <div class="text-truncate opacity-60"><?= $user_email ?></div>
                    </div>

                    <div class="sidemnenu mb-3">
                        <?php include("../layout/user_sidemnenu.php")?>
                    </div>
                </div>

                <div class="fixed-bottom d-xl-none bg-white border-top d-flex justify-content-between px-2"
                    style="box-shadow: 0 -5px 10px rgb(0 0 0 / 10%);">
                    <a class="btn btn-sm p-2 d-flex align-items-center" href="/logout">
                        <i class="las la-sign-out-alt fs-18 mr-2"></i>
                        <span>Logout</span>
                    </a>
                    <button class="btn btn-sm p-2" data-toggle="class-toggle" data-backdrop="static"
                        data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                        <i class="las la-times la-2x"></i>
                    </button>
                </div>
            </div>
            
            <div class="aiz-user-panel flex-grow-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Purchase History</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($orders->num_rows > 0): ?>
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-right">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($order = $orders->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showOrderDetails('<?= $order['id'] ?>')">#<?= $order['code'] ?></a>
                                            </td>
                                            <td><?= date('d-m-Y', strtotime($order['create_date'])) ?></td>
                                            <td><?= $order['total_items'] ?></td>
                                            <td><?= number_format($order['amount'], 0, ',', '.') ?> VND</td>
                                            <td>
                                                <?php 
                                                    $status = $order['delivery_status'] ?: 'Pending';
                                                    $status_class = 'badge-info';
                                                    
                                                    if ($status == 'Pending') $status_class = 'badge-secondary';
                                                    elseif ($status == 'Processing') $status_class = 'badge-info';
                                                    elseif ($status == 'Shipped') $status_class = 'badge-primary';
                                                    elseif ($status == 'Delivered') $status_class = 'badge-success';
                                                    elseif ($status == 'Cancelled') $status_class = 'badge-danger';
                                                ?>
                                                <span class="badge <?= $status_class ?>"><?= $status ?></span>
                                            </td>
                                            <td class="text-right">
                                                <a href="#" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="showOrderDetails('<?= $order['id'] ?>')" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="/invoice/<?= $order['code'] ?>" class="btn btn-soft-warning btn-icon btn-circle btn-sm" title="Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="text-center p-4">
                                <i class="las la-history la-3x opacity-60 mb-3"></i>
                                <h5>You haven't placed any orders yet</h5>
                                <a href="/" class="btn btn-primary mt-3">Start Shopping</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                Loading order details...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to show order details modal
    function showOrderDetails(orderId) {
        $('#orderDetailsModal').modal('show');
        
        // Load order details via AJAX
        fetch('/users/get_order_details.php?order_id=' + orderId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('orderDetailsContent').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('orderDetailsContent').innerHTML = 'Error loading order details';
                console.error('Error:', error);
            });
    }
</script>

<?php require_once(__DIR__ . "/../layout/footer.php"); ?>