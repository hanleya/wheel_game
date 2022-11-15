<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_GET["lobby"])) {

        $lid = $_GET["lobby"];

        echo json_encode(["ready" => check_finished($lid)]);
        
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }
?>