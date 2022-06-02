<?php
include "System/Rest.php";
function redirect(){
    $url = $_SERVER["REDIRECT_URL"];
    if($url == "/"){
        include "pages/index.php";
        return;
    }
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);
    $regular = "#\/rest\/(?<action>[\S]+)\/#";
    preg_match($regular, $url, $matches);
    $matches["action"]($data["value"]);
}
?>