<?php
include("../config.php");
echo $_SESSION['country'];

if(isset($_POST['currency_code'])){
    // $data=json_decode(file_get_contents("php://input"));
    // $country=$data->VND;
    $currency=$_POST['currency_code'];
    $_SESSION['currency']=$currency;
    $_SESSION['currency_character']=$currency=='USD'?'$':"VNĐ";
    
}
?>