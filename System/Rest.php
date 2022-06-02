<?php  

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
    $regular = "#[{}\(\)\[\]<>]#";
    $result = preg_match_all($regular, $string, $matches);
    if( !$result ) return false;
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
            if($value != $brackets[$elem]) {
                return false;
                
            };
        } else {
            $stack[] = $elem;
        }
    }
    return count($stack) == 0 ? true : false;
}

?>