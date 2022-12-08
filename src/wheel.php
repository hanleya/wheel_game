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
    <link href="wheel/wheel.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">    
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script src="wheel/wheel2.js"></script>
</head>
<body>
    <div>
        <h2 id="prompt"></h2>
        <form method="post" action="canvas.php">
            <input type="hidden" id="prompt-post" name="prompt">
            <input type="hidden" id="prompt-id-post" name="prompt-id">
            <input type="submit" id="start-btn" value="Start">
        </form>
    </div>
</body>
</html>