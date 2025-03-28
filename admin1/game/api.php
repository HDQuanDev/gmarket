<?php include("../../config.php");
if(isset($_GET['key'])){
     $key=$_GET['key'];
     $raw=fetch_array($con,"SELECT * FROM LotteryList WHERE `key`='$key' LIMIT 1");
     echo json_encode(array(
          "time"=>$SecondNow,
     ));
}


?>