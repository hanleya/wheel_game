
(function(){
    "use strict";

    var n = -1;

    window.addEventListener('load', init);
    
    function init() {
        document.getElementById("next-btn").addEventListener("click", get_next);
    }

    function disp_pic(response) {
        if(response.found == true) {
            document.getElementById("prompt").innerHTML = response.prompt;
            document.getElementById("player").innerHTML = response.playerName;
            document.getElementById("image").src = img_url(response.promptID);
            n++;
        } else {
        }
    }

    function img_url(prid) {
        return "img/lobbies/" + lobby + "/" + prid + ".jpg";
    }

    function get_next() {
        let url = "functions/next_picture.php?lobby=" + lobby + "&n=" + n;

        fetch(url)
            .then(check_status)
            .then(disp_pic);
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