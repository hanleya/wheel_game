<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_FILES["user_pic"])) {

        $file =  $_FILES["user_pic"];
        $path = "../img/lobbies/".$_POST["lid"]."/".basename($file['name']);

        if (move_uploaded_file($file['tmp_name'],$path)) {
            player_finished($_POST["pid"]);
            echo json_encode(["status" => "ok"]);
        } else {
            header("HTTP/1.1 500 Internal Server Error"); 
            echo $path;
        }
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required file!"; 
    }
?>