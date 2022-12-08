<?php 
    include "functions/db_functions.php";
    session_start();

    if (isset($_POST["prompt"]) and isset($_POST["prompt-id"]) and isset($_SESSION["lobby"]) and isset($_SESSION["player"])) {
        $lobby = $_SESSION["lobby"];
        $player = $_SESSION["player"];
        $prompt = $_POST["prompt"];
        $promptID = $_POST["prompt-id"];
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
    <link rel="stylesheet" href="canvas/canvas2.css"></link>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">    
    <script> lobby = "<?php echo $lobby;?>";</script>
    <script> player = "<?php echo $player;?>";</script>
    <script> prompt = "<?php echo $prompt;?>";</script>
    <script> promptID = "<?php echo $promptID;?>";</script>
    <script src="canvas/canvas.js"></script>
    <script src="https://kit.fontawesome.com/dcc3080eaf.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="top">
        <h1 id="prompt"><?php echo $prompt; ?></h1>
    </div>
    <div id="main">
        <canvas id="canvas"></canvas>
        <div id="pal_container">
            <div id="pal_weight">
                <button class="pal_button" id="small"><i class="fa-solid fa-circle fa-xs"></i></button>
                <button class="pal_button" id="medium"><i class="fa-solid fa-circle"></i></button>
                <button class="pal_button" id="large"><i class="fa-solid fa-circle fa-xl"></i></button>
                <button class="pal_button" id="eraser"><i class="fa-solid fa-eraser fa-xl"></i></button>
            </div>
            <div id="pal_color">
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
                <button class="pal_button"></button>
            </div>
        </div>
        <button id="done_button">Done</button>
    </div>
</body>

</html>