<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_GET["lobby"])) {
        $lid = $_GET["lobby"];
        $prompts = lobby_prompts($lid);
    
        if ($prompts !== false) {
            echo json_encode($prompts);
        } else {
            header("HTTP/1.1 400 Invalid Request"); 
            echo `Lobby {$lid} doesn't exist`; 
        }
        
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }
    
?>