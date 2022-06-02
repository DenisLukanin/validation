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



function insert(array $columns){
    $db_object = connect();
    $names_columns = array_keys($columns);

    $names_columns_string = implode(", ", $names_columns);
    $keys_placeholder = implode(", ", array_map(fn ($item) => ":".$item, $names_columns) );
    $request = "insert into history ($names_columns_string) value ($keys_placeholder)";
    $stm = $db_object->prepare($request); 

    foreach ($columns as $key => $value){
        $stm->bindValue($key , $value);
    }

    $stm->execute();

    return $db_object->lastInsertId();
}

?>