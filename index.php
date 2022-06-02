<?php 

    include "system/rest.php";
    include "system/db.php";
    
    if ($_SERVER["REDIRECT_URL"] == "/"){
        include "pages/index.php";
    } 
    if ($_SERVER["REDIRECT_URL"] == "/brackets/"){
        
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        brackets($data["value"]);
    }

?>
