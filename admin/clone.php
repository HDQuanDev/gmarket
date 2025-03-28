<?php 

function html1($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
}

// echo html1("/admin/clone/1.json");
echo file_get_contents("http://localhost/admin/clone/1.json");
?>