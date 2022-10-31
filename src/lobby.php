<?php 
    include "functions/db_functions.php";
    session_start();

    if (!(isset($_SESSION["lobby"]) or (!isset($_SESSION["player"])))) {
        header("Location: ../home.php");
    } else {
        $lobby = $_SESSION["lobby"];
        $player = $_SESSION["player"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script src="lobby/lobby.js"></script>
</head>
<body>
    <div id=players>

    </div>
    <div id=prompts>

    </div>
</body>
</html>