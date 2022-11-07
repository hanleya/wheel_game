<?php

    require "db_config.php";

    function connect() {
        global $database,$databasehost,$databaseuser,$databasepassword;
        $dsn = "mysql:host=$databasehost;dbname=$database;charset=UTF8";
        $pdo = new PDO($dsn, $databaseuser, $databasepassword);
        return $pdo;
    }

    
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    #  LOBBY FUNCTIONS
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    function get_lobby($code) {

        $query = "SELECT lobbyID FROM lobby WHERE accessCode = :c;";
        $params = [":c" => $code];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($res) ? $res["lobbyID"] : false;

    }

    function get_lobby_id($lid) {

        $query = "SELECT * FROM lobby WHERE lobbyID = :l;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;

    }

    function create_lobby($code) {

        $query = "INSERT INTO lobby (accessCode) VALUES (:c);";
        $params = [":c" => $code];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

    }

    function lobby_set_timer($lid) {

        $query = "UPDATE lobby SET timerStart = :t WHERE lobbyID = :l;";
        $params = [":l" => $lid, ":t" => time()];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

    }

    function setup_round($lid) {
        remove_inactive_players($lid);
        assign_prompts($lid);
        echo json_encode([]);
    }
    
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    #  PLAYER FUNCTIONS
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    function lobby_players($lid) {

        $query = "SELECT * FROM player WHERE :l = lobbyID;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();

    }

    function lobby_add_player($lid, $name) {

        $players = lobby_players($lid);

        foreach ($players as $p) {
            if ($p["playerName"] == $name) {
                return false;
            }
        }

        $query = "INSERT INTO player (lobbyID, playerName) VALUES (:l, :n);";
        $params = [":l" => $lid, ":n" => $name];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $query = "SELECT playerID FROM player WHERE playerName = :n AND lobbyID = :l";
        $params = [":l" => $lid, ":n" => $name];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC)["playerID"];

    }

    function player_ready($lid, $pid) {
        
        $query = "UPDATE player SET isReady = 1 WHERE :p = playerID;";
        $params = [":p" => $pid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);


        $lobby = get_lobby_id($lid);
        $response = ["first" => 0];

        if (is_null($lobby["timerStart"])) {
            lobby_set_timer($lid);
            $response["time_left"] = 15;
            $response["first"] = 1;
        } else {
            $response["time_left"] = 15 - (time() - $lobby["timerStart"]);
        }
        
        return json_encode($response);

    }

    function remove_inactive_players($lid) {

        $query = "DELETE FROM player WHERE lobbyID = :l AND isReady = 0;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

    }

    
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    #  PROMPT FUNCTIONS
    #~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    function lobby_prompts($lid) {

        $query = "SELECT * FROM prompt WHERE lobbyID = :l;";
        $params = [":l" => $lid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();

    }

    function add_prompt($lid, $prompt) {

        $query = "INSERT INTO prompt (lobbyID, prompt) VALUES (:l, :p);";
        $params = [":l" => $lid, ":p" => $prompt];

        $db = connect();
        $stmt = $db->prepare($query);

        return $stmt->execute($params);

    }

    function assign_prompts($lid) {

        $players = lobby_players($lid);
        $prompts = lobby_prompts($lid);
        $pr_count = count($prompts);

        foreach ($players as $pl) {
            $n = rand(0, $pr_count - 1);

            assign_to_player($pl["playerID"], $prompts[$n]["promptID"]);

            array_splice($prompts, $n, 1);
            $pr_count--;
        }

    }

    function assign_to_player($plid, $prid) {

        $query = "UPDATE prompt SET playerID = :pl WHERE promptID = :pr;";
        $params = [":pl" => $plid, ":pr" => $prid];

        $db = connect();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

    }

?>