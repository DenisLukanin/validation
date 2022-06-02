<?php

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

    // if($url == "/rest/brackets/"){
    //     $postData = file_get_contents('php://input');
    //     $data = json_decode($postData, true);
    //     aa($data["value"]);
        // aa($_POST);
        // $regular = "#action=(?<action>[\S]+)&[\s\S]?value=(?<value>[\S\s]+)#";
        // preg_match_all($regular, $query_string, $mathes);
        // $mathes["action"][0](str_replace("%20"," ",$mathes["value"][0]));
    // }
}

function brackets($value){
    insert([
        "validateString" => $value,
        "status" => intval(validate($value)),
    ]);
    $response = [
        "validate" => validate($value),
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
function validate($string){
    $status = [];
    $brackets = [
        ["[", "]"],
        ["(", ")"],
        ["{", "}"],
        ["<", ">"]
    ];
    foreach($brackets as $couple){
        $left = $couple[0];
        $right = $couple[1];
        $count_left = substr_count($string, $left);
        $count_right = substr_count($string, $right);
        if (!$count_left || !$count_right) {
            $status[] = "none";
            continue;
        };
        if (!$count_left || !$count_right) {
            return false;
        };
        if ((($count_left + $count_right) % 2)) {
            return false;
        };
        $count_group = ($count_left + $count_right) / 2;
        $slash = "";
        if($left == "[" || $left == "(") $slash == "\\";
        $regular = "$slash$left([\s\S]+?)$slash$right";
        preg_match_all($regular, $string, $matches);
        if (count($matches)/2 == $count_group) {
            $status[] = true;
        } else {
            return false;
        } 
    }
    return in_array(true, $status, true) ? true : false;
}

?>