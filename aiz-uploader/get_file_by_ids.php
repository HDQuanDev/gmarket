<?php
header("Content-type: application/json");
include("../config.php");
if($isLogin){
    $ids=explode(",",$_POST['ids']);

    
    $data=[];
    foreach($ids as $id){
        if($isAdmin)$checkExist=fetch_array("SELECT * FROM file WHERE id='$id'  LIMIT 1");
        else if($isSeller)$checkExist=fetch_array("SELECT * FROM file WHERE id='$id' and seller_id=$seller_id LIMIT 1");
        else $checkExist=fetch_array("SELECT * FROM file WHERE id='$id' and user_id=$user_id LIMIT 1");

        if($checkExist){
            $a=explode(".",$checkExist['src']);
            $extension=$a[count($a)-1];
            $data[]=array(
                "id"=> $checkExist['id'],
                // "file_original_name"=> "434722122_407019058618083_890352495166560540_n",
                "file_original_name"=> $checkExist['src'],

                "file_name"=> "/public/uploads/all/".$checkExist['src'],
                // "user_id"=> $user_id,
                "file_size"=> 320504,
                "extension"=> $extension,
                "type"=> "image",
                "external_link"=> null,
                "created_at"=> $checkExist['create_date'],
                "updated_at"=> "2024-10-10T04=>34=>10.000000Z",
                "deleted_at"=> null
            );
        }
    }

    echo json_encode($data);
}

?>
