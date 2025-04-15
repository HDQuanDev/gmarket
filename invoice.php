<?php
require_once("./config.php");

// Check if TCPDF is installed and use a simple alternative if not
if (file_exists('./vendor/autoload.php')) {
    require_once('./vendor/autoload.php');
    // Use proper namespace for TCPDF if available
    if (class_exists('TCPDF')) {
        class MYPDF extends TCPDF {
            public function Header() {
                $this->SetFont('helvetica', 'B', 16);
                $this->Cell(0, 15, 'Invoice', 0, true, 'C', 0, '', 0, false, 'M', 'M');
                $this->SetLineStyle(array('width' => 0.1, 'color' => array(200, 200, 200)));
                $this->Line(10, 20, $this->getPageWidth() - 10, 20);
            }
            
            public function Footer() {
                $this->SetY(-15);
                $this->SetFont('helvetica', 'I', 8);
                $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            }
        }
    }
}

if (!$isLogin) {
    header("Location: /users/login");
    exit;
}

$order_code = isset($_GET['code']) ? $_GET['code'] : '';

// Validate order code
if (empty($order_code)) {
    header("Location: /purchase_history.php");
    exit;
}

// Get order details from database
$order_query = "SELECT o.* FROM orders o
                WHERE o.code = ? AND o.user_id = ? LIMIT 1";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("si", $order_code, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    header("Location: /purchase_history.php");
    exit;
}

// Get order items
$items_query = "SELECT od.*, 
                s.full_name as seller_name, s.shop_name, s.shop_logo
                FROM detail_orders od 
                LEFT JOIN sellers s ON od.from_seller = s.id 
                WHERE od.order_id = ?
                ORDER BY od.from_seller, od.id";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("i", $order['id']);
$stmt->execute();
$items = $stmt->get_result();

// We'll use the global user variables from config.php instead of querying again
$customer_name = $user_name ?? "Customer";
$customer_email = $user_email ?? "-";
$customer_phone = $user_phone ?? "-";

// Start creating HTML format (default if TCPDF not available)
$output_format = 'html';

// If we have TCPDF loaded, use it for PDF generation
if (isset($MYPDF) && class_exists('TCPDF')) {
    $output_format = 'pdf';
    
    // Create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('GMarket');
    $pdf->SetAuthor('GMarket');
    $pdf->SetTitle('Invoice #' . $order['code']);
    $pdf->SetSubject('Invoice for Order #' . $order['code']);
    $pdf->SetKeywords('Invoice, Order, GMarket');

    // Set default header data
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(true);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 11);

    // Buyer information
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Invoice Details', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 10);

    $pdf->Cell(40, 6, 'Invoice Number:', 0, 0, 'L');
    $pdf->Cell(0, 6, 'INV-' . $order['code'], 0, 1, 'L');

    $pdf->Cell(40, 6, 'Date Issued:', 0, 0, 'L');
    $pdf->Cell(0, 6, date('F d, Y', strtotime($order['create_date'])), 0, 1, 'L');

    $pdf->Cell(40, 6, 'Order Status:', 0, 0, 'L');
    $pdf->Cell(0, 6, $order['delivery_status'], 0, 1, 'L');

    $pdf->Cell(40, 6, 'Payment Method:', 0, 0, 'L');
    $pdf->Cell(0, 6, ucwords(str_replace('_', ' ', $order['payment_option'])), 0, 1, 'L');

    $pdf->Cell(40, 6, 'Payment Status:', 0, 0, 'L');
    $pdf->Cell(0, 6, $order['payment_status'], 0, 1, 'L');

    $pdf->Ln(5);

    // Customer and Shipping details in two columns
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(90, 10, 'Customer Information', 0, 0, 'L');
    $pdf->Cell(90, 10, 'Shipping Address', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 10);

    // Set content in columns
    $customer_info = "Name: " . $customer_name . "\n";
    $customer_info .= "Email: " . $customer_email . "\n";
    if (!empty($customer_phone)) {
        $customer_info .= "Phone: " . $customer_phone . "\n";
    }

    $pdf->MultiCell(90, 20, $customer_info, 0, 'L', 0, 0);
    $pdf->MultiCell(90, 20, $order['address'], 0, 'L', 0, 1);

    $pdf->Ln(5);

    // Order items table
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Order Items', 0, 1, 'L');

    // Create table header
    $pdf->SetFillColor(240, 240, 240);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(10, 8, '#', 1, 0, 'C', 1);
    $pdf->Cell(80, 8, 'Product', 1, 0, 'C', 1);
    $pdf->Cell(30, 8, 'Seller', 1, 0, 'C', 1);
    $pdf->Cell(20, 8, 'Price', 1, 0, 'C', 1);
    $pdf->Cell(15, 8, 'Qty', 1, 0, 'C', 1);
    $pdf->Cell(25, 8, 'Total', 1, 1, 'C', 1);

    // Fill table data
    $pdf->SetFont('helvetica', '', 9);
    $subtotal = 0;
    $counter = 1;

    while ($item = $items->fetch_assoc()) {
        $seller_name = !empty($item['shop_name']) ? $item['shop_name'] : ($item['seller_name'] ?: 'Marketplace');
        $item_total = $item['price'] * $item['quantity'];
        $subtotal += $item_total;
        
        // Check if we need a new page for this row
        if ($pdf->GetY() > 250) {
            $pdf->AddPage();
            
            // Recreate header on new page
            $pdf->SetFillColor(240, 240, 240);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(10, 8, '#', 1, 0, 'C', 1);
            $pdf->Cell(80, 8, 'Product', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Seller', 1, 0, 'C', 1);
            $pdf->Cell(20, 8, 'Price', 1, 0, 'C', 1);
            $pdf->Cell(15, 8, 'Qty', 1, 0, 'C', 1);
            $pdf->Cell(25, 8, 'Total', 1, 1, 'C', 1);
            $pdf->SetFont('helvetica', '', 9);
        }
        
        $pdf->Cell(10, 8, $counter, 1, 0, 'C');
        $pdf->Cell(80, 8, $item['name'], 1, 0, 'L');
        $pdf->Cell(30, 8, $seller_name, 1, 0, 'L');
        $pdf->Cell(20, 8, '$' . number_format($item['price'], 2), 1, 0, 'R');
        $pdf->Cell(15, 8, $item['quantity'], 1, 0, 'C');
        $pdf->Cell(25, 8, '$' . number_format($item_total, 2), 1, 1, 'R');
        
        $counter++;
    }

    // Totals
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(155, 8, 'Subtotal:', 1, 0, 'R');
    $pdf->Cell(25, 8, '$' . number_format($subtotal, 2), 1, 1, 'R');

    $pdf->Cell(155, 8, 'Shipping Fee:', 1, 0, 'R');
    $pdf->Cell(25, 8, '$0.00', 1, 1, 'R');

    // Check for other fees or discounts here if needed

    $pdf->SetFillColor(245, 245, 245);
    $pdf->Cell(155, 8, 'Grand Total:', 1, 0, 'R', 1);
    $pdf->Cell(25, 8, '$' . number_format($order['amount'], 2), 1, 1, 'R', 1);

    // Additional notes
    if (!empty($order['additional_info'])) {
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 8, 'Additional Information:', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->MultiCell(0, 5, $order['additional_info'], 0, 'L', 0, 1);
    }

    // Terms and conditions
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 8, 'Terms & Conditions:', 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->MultiCell(0, 4, 'This is an electronically generated invoice and does not require a physical signature. For any questions regarding this invoice, please contact customer support.', 0, 'L', 0, 1);

    // Output the PDF
    $pdf->Output('Invoice_' . $order['code'] . '.pdf', 'D'); // 'D' means download the file
} else {
    // Fallback if TCPDF is not available - Create a simple HTML invoice
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Invoice #" . htmlspecialchars($order['code']) . "</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
            .container { max-width: 800px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; }
            h1 { text-align: center; color: #333; }
            .info-section { margin-bottom: 20px; }
            .row { display: flex; margin-bottom: 10px; }
            .label { font-weight: bold; width: 150px; }
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .total-row td { font-weight: bold; }
            .print-btn { display: block; text-align: center; margin: 20px 0; }
            .print-btn button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
            .header { text-align: center; padding: 20px 0; border-bottom: 1px solid #ddd; margin-bottom: 20px; }
            .logo { max-width: 200px; margin-bottom: 10px; }
            .flex-container { display: flex; }
            .flex-container > div { flex: 1; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Invoice #" . htmlspecialchars($order['code']) . "</h1>
                <p>Date: " . date('F d, Y', strtotime($order['create_date'])) . "</p>
            </div>
            
            <div class='info-section'>
                <div class='row'>
                    <div class='label'>Order Status:</div>
                    <div>" . htmlspecialchars($order['delivery_status']) . "</div>
                </div>
                <div class='row'>
                    <div class='label'>Payment Method:</div>
                    <div>" . ucwords(str_replace('_', ' ', $order['payment_option'])) . "</div>
                </div>
                <div class='row'>
                    <div class='label'>Payment Status:</div>
                    <div>" . htmlspecialchars($order['payment_status']) . "</div>
                </div>
            </div>
            
            <div class='flex-container'>
                <div>
                    <h3>Customer Information</h3>
                    <p>Name: " . htmlspecialchars($customer_name) . "<br>
                    Email: " . htmlspecialchars($customer_email) . "<br>" .
                    (!empty($customer_phone) ? "Phone: " . htmlspecialchars($customer_phone) . "<br>" : "") . "
                    </p>
                </div>
                <div>
                    <h3>Shipping Address</h3>
                    <p>" . nl2br(htmlspecialchars($order['address'])) . "</p>
                </div>
            </div>
            
            <h3>Order Items</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Seller</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
    
    // Reset items result pointer
    $items->data_seek(0);
    $subtotal = 0;
    $counter = 1;
    
    while ($item = $items->fetch_assoc()) {
        $seller_name = !empty($item['shop_name']) ? $item['shop_name'] : ($item['seller_name'] ?: 'Marketplace');
        $item_total = $item['price'] * $item['quantity'];
        $subtotal += $item_total;
        
        echo "<tr>
                <td>" . $counter . "</td>
                <td>" . htmlspecialchars($item['name']) . "</td>
                <td>" . htmlspecialchars($seller_name) . "</td>
                <td>$" . number_format($item['price'], 2) . "</td>
                <td>" . $item['quantity'] . "</td>
                <td>$" . number_format($item_total, 2) . "</td>
            </tr>";
        
        $counter++;
    }
    
    echo "    <tr>
                    <td colspan='5' style='text-align:right;'>Subtotal:</td>
                    <td>$" . number_format($subtotal, 2) . "</td>
                </tr>
                <tr>
                    <td colspan='5' style='text-align:right;'>Shipping Fee:</td>
                    <td>$0.00</td>
                </tr>
                <tr class='total-row'>
                    <td colspan='5' style='text-align:right;'>Grand Total:</td>
                    <td>$" . number_format($order['amount'], 2) . "</td>
                </tr>
            </tbody>
        </table>";
    
    if (!empty($order['additional_info'])) {
        echo "<div class='info-section'>
                <h3>Additional Information</h3>
                <p>" . nl2br(htmlspecialchars($order['additional_info'])) . "</p>
            </div>";
    }
    
    echo "<div class='info-section'>
            <h3>Terms & Conditions</h3>
            <p>This is an electronically generated invoice and does not require a physical signature. For any questions regarding this invoice, please contact customer support.</p>
        </div>
        
        <div class='print-btn'>
            <button onclick='window.print()'>Print Invoice</button>
            <a href='/purchase_history.php' style='display: inline-block; margin-left: 20px;'>Back to Orders</a>
        </div>
    </div>
    <script>
        // Auto-print if needed
        // window.onload = function() { window.print(); }
    </script>
    </body>
    </html>";
}

exit;
?>
