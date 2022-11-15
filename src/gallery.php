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
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script src="gallery/gallery.js"></script>
    <title>Document</title>
</head>
<body>
    <h1 id="prompt"></h1>
    <h2 id="player"></h2>
    <img id="image">
    <button id="next-btn">Next</button>
</body>
</html>