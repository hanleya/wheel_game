(function(){

    var prompt_set = false;

    window.addEventListener('load', init);
    
    function init() {

        setInterval(get_prompts, 2000);

        document.getElementById("start-btn").addEventListener("click", to_canvas);

    }

    function check_prompt(response) {
        var prompt = null;

        response.forEach(p => {
            if (p["playerID"] == player) {
                prompt = p;
            }
        });

        if (prompt !== null) {
            document.getElementById("prompt").innerHTML = prompt["prompt"];
            prompt_set = true;
        }
    }

    function to_canvas() {
        if (prompt_set) {
            window.location.href = "canvas.html";
        }
    }

    function get_prompts() {
        let url = "functions/get_prompts.php?lobby=" + lobby;

        fetch(url)
            .then(check_status)
            .then(check_prompt);
    }

    function check_status(response) {
        if (response.ok) {
            return response.json();
        } else {
            console.log(response);
            return Promise.reject(new Error(response.status + "   " + response.statusText));
        }
    }

})();