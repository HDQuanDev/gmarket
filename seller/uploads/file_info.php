<?php
include("../../config.php");

if($isSeller && file_get_contents("php://input")){
    $data=[];
    parse_str(file_get_contents("php://input"), $data);

    $file_id=$data['id'];
    
    $file=fetch_array("SELECT * FROM file WHERE id=$file_id LIMIT 1");
    if(!$file)die();
}
else die();
?>
<div>
	<div class="form-group">
		<label>File Name</label>
		<input type="text" class="form-control" value="uploads/all/<?=$file['src']?>" disabled>
	</div>
	<div class="form-group">
		<label>File Type</label>
		<input type="text" class="form-control" value="<?=$file['type']?>" disabled>
	</div>
	<div class="form-group">
		<label>File Size</label>
		<input type="text" class="form-control" value="<?=formatFileSize($file['size'])?>" disabled>
	</div>
	<div class="form-group">
		<label>Uploaded At</label>
		<input type="text" class="form-control" value="<?=$file['create_date']?>" disabled>
	</div>
	<div class="form-group text-center">
		<a class="btn btn-secondary" href="<?=$domain?>/public/uploads/all/<?=$file['src']?>" target="_blank" download="<?=$row['src']?>">Download</a>
	</div>
</div>