(function(){
    "use script";

    const BASE_URL = "http://localhost/wheel_game/functions/"; //TEMPORARY: GIVE REAL URL LATER

    //~~~~~~~~~~~~~~~~~~~~~~~
    //  INITIALIZATION
    //~~~~~~~~~~~~~~~~~~~~~~~
    
    window.addEventListener('load', init);
    
    function init() {
        get_players();
        get_prompts();
        setInterval(get_players, 2000);
        setInterval(get_prompts, 2000);
        document.getElementById("prompt-btn").addEventListener("click", add_prompt);
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

    function update_prompts(prompts) {
        let p_div = document.getElementById("prompt-list");

        p_div.innerHTML = "";

        prompts.forEach((p) => {
            let par = document.createElement("p");
            par.innerHTML = p["prompt"];
            p_div.appendChild(par);
        });
    }


    //~~~~~~~~~~~~~~~~~~~~~~~~
    //  DB QUERIES
    //~~~~~~~~~~~~~~~~~~~~~~~~

    function get_players() {
        let url = "functions/get_players.php?lobby=" + lobby;

        fetch(url)
            .then(check_status)
            .then(update_players);
    }

    function get_prompts() {
        let url = "functions/get_prompts.php?lobby=" + lobby;

        fetch(url)
            .then(check_status)
            .then(update_prompts);
    }

    function add_prompt() {
        let prompt = document.getElementById("prompt-in").value;
        let url = "functions/add_prompt.php?lobby=" + lobby + "&prompt=" + prompt;

        fetch(url)
            .then(get_prompts);
    }

    function check_status(response) {
        if (response.ok) {
            return response.json();
        } else {
            return Promise.reject(new Error(response.status + response.statusText));
        }
    }


})();