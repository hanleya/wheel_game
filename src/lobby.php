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
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script src="lobby/lobby.js"></script>
</head>
<body>
    <div id=players></div>
    <div id=prompts>
        <input type="text" id="prompt-in">
        <button id="prompt-btn">Submit</button>
        <div id=prompt-list></div>
    </div>
    <button id="start-btn">Start</button>
</body>
</html>