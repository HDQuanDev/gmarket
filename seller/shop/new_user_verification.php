<?php
include("../../config.php");

// header("Content-type: application/json");

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $checkExist=fetch_array("SELECT id FROM users WHERE email='$email' LIMIT 1") || fetch_array("SELECT id FROM sellers WHERE email='$email' LIMIT 1");
    if($checkExist){
        // echo json_encode(array("status"=>2,"message"=>"Email already exists!"));
        echo json_encode(array("status"=>0,"message"=>"Email already exists!"));

    }
    else{
        echo json_encode(array("status"=>1,"message"=>"Email is OK"));
    }
}


?>