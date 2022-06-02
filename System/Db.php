<?php 

function connect(){
    $connection = new PDO("mysql:host=localhost;dbname=validate;charset=utf8", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
    
}

function create_table(){

    
    $db_object = connect();
    $reqest = "
        CREATE TABLE `history` ( 
        `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
        `validateString` VARCHAR(100) NOT NULL , 
        `status` INT(11) NOT NULL 
    );";
    $result = $db_object->prepare($reqest);
    $result->execute();
}

function select(){
    $db_object = connect();
    $request = "SELECT * FROM history";
    $result = $db_object->prepare($request);
    $result->execute();
    return $result;
}

function insert(array $arr){
    $db_object = connect();
    $keys = implode(", ", array_keys($arr));
    $keys_placeholder = implode(", ", array_map(fn ($item) => ":".$item, array_keys($arr)) );
    $stm = $db_object->prepare("insert into history ($keys) value ($keys_placeholder)");
    foreach ($arr as $name => $value){
        $stm->bindValue($name , $value);
    }
    $stm->execute();
    return $db_object->lastInsertId();
}

?>