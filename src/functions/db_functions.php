<?php

    require "db_config.php";

    function connect() {
        global $database,$databasehost,$databaseuser,$databasepassword;
        $dsn = "mysql:host=$databasehost;dbname=$database;charset=UTF8";
        $pdo = new PDO($dsn, $databaseuser, $databasepassword);
        return $pdo;
    }

    function get_lobby($code) {

        $query = "SELECT lobbyID FROM lobby WHERE accessCode = :c;";
        $params = [":c" => $code];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($res) ? $res["lobbyID"] : false;

    }

    function create_lobby($code) {

        $query = "INSERT INTO lobby (accessCode) VALUES (:c);";
        $params = [":c" => $code];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

    }

    function lobby_players($lid) {

        $query = "SELECT * FROM player WHERE lobbyID = $lid;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();

    }

    function lobby_add_player($lid, $name) {

        $n = count(lobby_players($lid)) + 1;

        $query = "INSERT INTO player (lobbyID, playerName, playerNum) VALUES (:l, :name, :num);";
        $params = [":l" => $lid, ":name" => $name, ":num" => $n];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        return $n;

    }

?>