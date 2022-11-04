<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_GET["player"]) and isset($_GET["lobby"])) {
        echo player_ready($_GET["lobby"], $_GET["player"]);
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }
    
?>