<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_GET["lobby"]) && isset($_GET["n"])) {
        echo get_next_prompt($_GET["lobby"], $_GET["n"]);
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }
    
?>