(function(){

    var interval;

    window.addEventListener('load', init);
    
    function init() {

        interval = setInterval(get_prompts, 500);
        document.getElementById("start-btn").disabled = true;

    }

    function check_prompt(response) {
        var prompt = null;

        response.forEach(p => {
            if (p["playerID"] == player) {
                prompt = p;
            }
        });

        if (prompt !== null) {
            clearInterval(interval);
            document.getElementById("prompt").innerHTML = prompt["prompt"];
            document.getElementById("prompt-post").value = prompt["prompt"];
            document.getElementById("start-btn").disabled = false;
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