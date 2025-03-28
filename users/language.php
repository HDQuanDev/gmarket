<?php
include("../config.php");
echo $_SESSION['country'];

if(isset($_POST['locale'])){
    // $data=json_decode(file_get_contents("php://input"));
    // $country=$data->locale;
    $country=$_POST['locale'];
    $arr=array("vn"=>"vi","en"=>"en","kr"=>"ko","jp"=>"ja");
    $_SESSION['country']=$arr[$country];
    
}
?>