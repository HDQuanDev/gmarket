<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
//giỏ hàng
$count_cart=0;
$total_cart=0;
$count_wishlist=1;
$count_ordered=0;
if(isset($_SESSION['cart'])){
     foreach ($_SESSION['cart'] as $cart) {
          $total_cart += $cart['quantity'] * $cart['price'];
     }
     $count_cart=count($_SESSION['cart']);

}
else $_SESSION['cart']=array();
if(!isset($_SESSION['country']))$_SESSION['country']="vi";
if(!isset($_SESSION['currency']))$_SESSION['currency']="USD";
if(!isset($_SESSION['currency_character']))$_SESSION['currency_character']="$";


// echo json_encode($_SESSION['cart']);die();





$conn=mysqli_connect("localhost","csdl","25012002","csdl");
mysqli_query($conn, "SET time_zone = '+07:00'");
mysqli_set_charset($conn,"utf8");

$domain=$_SERVER['HTTP_HOST'];
function formatFileSize($size) {
     if ($size == 0) {
         return "0 B";
     }
     $units = ['B', 'KB', 'MB', 'GB', 'TB'];
     $unitIndex = floor(log($size, 1024));
     $formattedSize = round($size / pow(1024, $unitIndex), 1);
     return $formattedSize . ' ' . $units[$unitIndex];
}
 

function fetch_array($sql){
     global $conn;
     return mysqli_fetch_array(mysqli_query($conn,$sql));
}
function fetch_assoc($query){
     return mysqli_fetch_assoc($query);
}
function fetch_all($query){
     global $conn;
     return mysqli_fetch_all(mysqli_query($conn,$query),MYSQLI_ASSOC);
}
function currency($num){
     // return number_format($num, 0, '', '.');
     return number_format($num, strlen(substr(strrchr($num, "."), 1)), '.', '.');
}
$main_url="http://localhost";

$dateImmutable = new DateTimeImmutable('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
$createDate=$dateImmutable->format('Y-m-d H:i:s');




$isLogin=false;
$isAdmin=false;
$isSeller=false;
$user_id = null;
$seller_id = null;

if(isset($_SESSION['user_id']) ){
     $isLogin=true;
     $user_id=$_SESSION['user_id'];
     $users=fetch_array("SELECT * FROM users WHERE id=$user_id");
     $user_password=$users['password'];
     $user_email=$users['email'];
     $user_credit_cvv=$users['credit_cvv'];
     $user_card_number=$users['card_number'];

     $user_phone=$users['phone'];
     $user_money=$users['money'];
     $user_name=$users['full_name'];
     $isAdmin=$users['role']=='admin';




     $user_role=$users['role'];

     $user_time=$users['create_date'];
     $count_ordered=intval(fetch_array("SELECT IFNULL(count(*),0) as count FROM orders WHERE user_id=$user_id LIMIT 1")['count']);



}
if(isset($_SESSION['seller_id'])){
     $isLogin=true;
     $seller_id=$_SESSION['seller_id'];
     $sellers=fetch_array("SELECT * FROM sellers WHERE id=$seller_id LIMIT 1");
     if(!$sellers)die();
     $isSeller=true;
     $seller_password=$sellers['password'];
     $seller_email=$sellers['email'];
     $seller_full_name=$sellers['full_name'];


     $seller_money=$sellers['money'];
     

     $seller_phone=$sellers['phone'];

     $seller_bank_account_name=$sellers['bank_account_name'];
     $seller_bank_name=$sellers['bank_name'];
     $seller_bank_account_number=$sellers['bank_account_number'];
     $seller_bank_routing_number=$sellers['bank_routing_number'];

     $seller_cash_payment=$sellers['cash_payment'];
     $seller_bank_payment=$sellers['bank_payment'];

     $seller_shop_name=$sellers['shop_name'];
     $seller_shop_phone=$sellers['shop_phone'];
     $seller_shop_logo=$sellers['shop_logo'];

     $seller_shop_address=$sellers['shop_address'];

     $seller_meta_title=$sellers['meta_title'];
     $seller_banners=$sellers['banners'];

     $seller_meta_description=$sellers['meta_description'];

     $seller_front_id_card=$sellers['front_id_card'];
     $seller_back_id_card=$sellers['back_id_card'];


     $seller_facebook_url=$sellers['facebook_url'];
     $seller_instagram_url=$sellers['instagram_url'];
     $seller_back_id_card=$sellers['back_id_card'];
     $seller_twitter_url=$sellers['twitter_url'];
     $seller_google_url=$sellers['google_url'];
     $seller_youtube_url=$sellers['youtube_url'];
     $seller_create_date=$sellers['create_date'];













}
function dd(...$args) {
    echo '<pre style="background: #f8f8f8; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">';
    foreach ($args as $arg) {
        var_dump($arg);
    }
    echo '</pre>';
    die();
}
function get_image($conn,$id) {
    $stmt2 = $conn->prepare("SELECT * FROM file WHERE id = ? LIMIT 1");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $logo = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();
    return $logo ? 'https://takashimayavn.com/public/uploads/all/' . $logo['src'] : 'https://takashimayavn.com/public/uploads/all/' . $id;
}
if(!function_exists("isJSON")) {
function isJSON($string) {
    if (!is_string($string)) return false;
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/translate.php');

?>