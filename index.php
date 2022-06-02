
<?php 
    function aa($value){
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    };
    function aar($value){
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    };
    include "system/route.php";
    include "system/db.php";
    

    redirect();
?>
