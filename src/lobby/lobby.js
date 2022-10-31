(function(){
    "use script";

    const BASE_URL = "http://localhost/wheel_game/functions/"; //TEMPORARY: GIVE REAL URL LATER

    //~~~~~~~~~~~~~~~~~~~~~~~
    //  INITIALIZATION
    //~~~~~~~~~~~~~~~~~~~~~~~
    
    window.addEventListener('load', init);
    
    function init() {
        get_players();
    }
    

    //~~~~~~~~~~~~~~~~~~~~~~~~
    //  UPDATE FUNCTIONS
    //~~~~~~~~~~~~~~~~~~~~~~~~

    function update_players(players) {
        let p_div = document.getElementById("players");

        p_div.innerHTML = "";

        players.forEach((p) => {
            let par = document.createElement("p");
            par.innerHTML = p["playerName"];
            p_div.appendChild(par);
        });
    }


    //~~~~~~~~~~~~~~~~~~~~~~~~
    //  DB QUERIES
    //~~~~~~~~~~~~~~~~~~~~~~~~

    function get_players() {
        let url = "functions/get_lobby.php?lobby=" + lobby;

        fetch(url)
            .then(checkStatus)
            .then(update_players);
    }

    function checkStatus(response) {
        if (response.ok) {
            return response.json();
        } else {
            return Promise.reject(new Error(response.status + ": " + response.statusText));
        }
    }


})();