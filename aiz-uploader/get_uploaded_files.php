
<?php
header("Content-type: application/json");
include("../config.php");

if($isLogin){
    $data=[];
    if($isAdmin)$sql=mysqli_query($conn,"SELECT * FROM file WHERE user_id=$user_id LIMIT 200");
    else if($isSeller)$sql=mysqli_query($conn,"SELECT * FROM file WHERE seller_id=$seller_id LIMIT 200");
    else $sql=mysqli_query($conn,"SELECT * FROM file WHERE user_id=$user_id LIMIT 200");

    while($row=fetch_assoc($sql)){
        $a=explode(".",$row['src']);
        $extension=$a[count($a)-1];
        $data[]=array(
            "id"=> $row['id'],
            // "file_original_name"=> "434722122_407019058618083_890352495166560540_n",
            "file_original_name"=> $row['src'],

            "file_name"=> "/public/uploads/all/".$row['src'],
            // "user_id"=> $user_id,
            "file_size"=> 320504,
            "extension"=> $extension,
            "type"=> "image",
            "external_link"=> null,
            "created_at"=> $row['create_date'],
            "updated_at"=> "2024-10-10T04:34:10.000000Z",
            "deleted_at"=> null

        );
    }
    echo json_encode(array(
        "current_page"=> 1,
        "data"=>$data,
        "first_page_url"=> "\/aiz-uploader\/get_uploaded_files?sort=newest&page=1",
        "from"=> 1,
        "last_page"=> 1,
        "last_page_url"=> "\/aiz-uploader\/get_uploaded_files?sort=newest&page=1",
        "links"=>[
            array(
                "url"=> null,
                "label"=> "\u00ab Previous",
                "active"=> false
            ),
            array(
                "url"=> "\/aiz-uploader\/get_uploaded_files?sort=newest&page=1",
                "label"=> "1",
                "active"=> true
            ),
            array(
                "url"=> null,
                "label"=> "Next \u00bb",
                "active"=> false
            ),
        ],
        "next_page_url"=> null,
        // "https://tmdtquocte.com/aiz-uploader/get_uploaded_files?sort=newest&page=2"
        "path"=> "\/aiz-uploader\/get_uploaded_files",
        "per_page"=> 60,
        "prev_page_url"=> null,
        "to"=> 1,
        "total"=> 1
       
    ));
}


?>
