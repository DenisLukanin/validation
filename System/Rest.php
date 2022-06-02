<?php

function brackets($string){
    $status = validate($string);

    Db::get_instance()->insert([
        "validateString" => $string,
        "status" => intval($status),
    ]);
    $response = [
        "validate" => $status,
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


function validate($string){
    $regular = "#[{}\(\)\[\]<>]#";
    $result_preg = preg_match_all($regular, $string, $matches);

    if( !$result_preg ) return false;

    if( count($matches[0]) % 2 != 0 ) return false;

    $stack = [];
    $brackets = [
        "}" => "{",
        "]" => "[",
        ")" => "(",
        ">" => "<"
    ];
    foreach ($matches[0] as  $elem) {

        if (in_array($elem , array_keys($brackets))){
            $value = array_pop($stack);

            if ($value != $brackets[$elem]) {
                return false;
            };

        } else {
            $stack[] = $elem;
        }
    }
    return count($stack) == 0;
}

?>