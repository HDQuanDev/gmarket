<?php

include("../../config.php");
$sql=mysqli_query($con,"SELECT * FROM HistoryOrder ORDER BY id desc");
while($r=fetch_assoc($sql)){
    $name=$r['name'];
    $img=$r['img'];
    @mysqli_query($con,"UPDATE Products SET name='$name' WHERE img='$img'");
    echo $name."=>".$img."<br>";
}
?>