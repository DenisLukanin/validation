<?php 

    include "system/route.php";
    include "system/db.php";
    

    try {
        redirect();
    } catch ( Exception $e) {
        echo "Обнаружена ошибка {$e->getCode()} '{$e->getMessage()}'";
    }
?>
