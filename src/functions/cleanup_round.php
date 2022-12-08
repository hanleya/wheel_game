<?php
    require "db_functions.php";

    header("Content-Type: application/json; charset=utf-8");

    if (isset($_GET["lobby"])) {

        $lid = $_GET["lobby"];

        delete_lobby($lid);
        
        echo json_encode([]);
        
    } else {
        header("HTTP/1.1 400 Invalid Request"); 
        echo "Missing required parameter!"; 
    }

    function delete_lobby($lid) {

        $query = "DELETE FROM lobby WHERE lobbyID = :l;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        

        $query = "DELETE FROM player WHERE lobbyID = :l;";

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);


        $query = "DELETE FROM prompt WHERE lobbyID = :l;";

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);


        foreach (glob("../img/lobbies/".$lid."/*.jpg") as $file) {
            unlink($file);
        }

        rmdir("../img/lobbies/".$lid);

    }
?>