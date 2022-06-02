<?php
    // spl_autoload_register(function($path){ 
    //         $class_path = __DIR__."\\".$path.".php";
    //         aa($class_path);
    //         if (file_exists($class_path)){
    //             include $class_path;
    //         }
    //     }
    // );
    spl_autoload_register(function($path){ 
        $path = str_replace("\\", "/", $path);
        $class_path = __DIR__."\\".$path.".php";
        if (file_exists($class_path)){
            include $class_path;
        }
    }
    );