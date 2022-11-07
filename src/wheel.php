<?php 
    include "functions/db_functions.php";
    session_start();

    if (isset($_SESSION["lobby"]) and isset($_SESSION["player"])) {
        $lobby = $_SESSION["lobby"];
        $player = $_SESSION["player"];
    } else {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>