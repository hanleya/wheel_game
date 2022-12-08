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
    <link href="lobby/lobby.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">    
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script src="lobby/lobby2.js"></script>
</head>
<body>
    <div>
        <div id=players>
            <h2>Players</h2>
            <div id=player-list></div>
            <button id="start-btn">Start</button>
        </div>
        <div id=prompts>
            <h2>Prompts</h2>
            <div id=prompt-list></div>
            <input type="text" id="prompt-in">
            <button id="prompt-btn">Submit</button>
        </div>
    </div>
</body>
</html>