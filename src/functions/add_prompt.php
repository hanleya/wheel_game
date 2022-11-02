<?php
    require "db_functions.php";

    header("Content-Type: text/plain; charset=utf-8");

    if (isset($_GET["lobby"]) && isset($_GET["prompt"])) {
        $lid = $_GET["lobby"];
        $prompt = $_GET["prompt"];
    
        if (add_prompt($lid, $prompt)) {
            echo "Ok";
        } else {
            header("HTTP/1.1 500 Internal Server Error"); 
            echo `Error inserting into {$lid}`; 
        }
        
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }
    
?>