<?php

    require "../functions/db_functions.php";

    if (!isset($_POST["action"])) {
        header("Location: ../home.php");
    }

    $name = $_POST["name"];
    $code = $_POST["code"];

    if ($_POST["action"] == "create") {
        if (get_lobby($code)) {
            echo "lobby already exists";
        } else {
            session_start();

            create_lobby($code);
            $lobby = get_lobby($code);
            $_SESSION["lobby"] = $lobby;
            mkdir("../img/lobbies/".$lobby);

            $player = lobby_add_player($lobby, $name); 
            $_SESSION["player"] = $player;

            header("Location: ../lobby.php");
        }
    } else {
        $lobby = get_lobby($code);

        if ($lobby == false) {
            echo "lobby doesn't exist";
        } else {
            session_start();
            $_SESSION["lobby"] = $lobby;

            $player = lobby_add_player($lobby, $name); 

            if ($player) {
                $_SESSION["player"] = $player;
                header("Location: ../lobby.php");
            } else {
                echo "name taken in this lobby";
            }
        }
    }

?>