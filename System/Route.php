<?php

include "System/Rest.php";


function redirect(){
    $url = $_SERVER["REDIRECT_URL"];
    $data = parse_post_json();
    $regular_rest = "#\/rest\/(?<action>[\S]+)\/#";

    if($url == "/"){
        include "pages/index.php";
        return;
    }

    if (preg_match($regular_rest, $url, $matches)){
        $rest_action = $matches["action"];
        $string = $data["value"];

        call_user_func($rest_action, $string);
        return;
    };
    
    throw new Exception("url undefined", 404);
}


function parse_post_json(){

    $postData = file_get_contents('php://input');
    return json_decode($postData, true);

}
?>