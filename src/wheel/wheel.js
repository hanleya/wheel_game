

    var prompt_list = ["a", "b", "c", "d", "e", "f", "g", "h"];
    var prompt_list_b = ["i", "j", "k", "l"];

    var u_prompts = [];
    var u_prompts_b = [];

    var user = 0;

    /**
     * Assigns prompts to players at the beginning of a new round.
     * @param {int} n - number of players in lobby
     * @param {boolean} d - if round is a double round
     * @param {boolean} b - if game is using two lists
     */
    function assignPrompts(n, d, b) {
        u_prompts = [];
        u_prompts_b = [];

        if (prompt_list.length < (d ? 2 * n : n) || (b && prompt_list_b.length < n )) {
            console.warn("too few prompts");
            return false;
        }

        for (let i = 0; i < n; i++) {
            u_prompts.push(...prompt_list.splice(randBelow(prompt_list.length), 1));
            console.warn(u_prompts[u_prompts.length - 1]);

            if (d) {
                u_prompts_b.push(...prompt_list.splice(randBelow(prompt_list.length), 1));
                console.warn(u_prompts_b[u_prompts_b.length - 1]);
            } else if (b) {
                u_prompts_b.push(...prompt_list_b.splice(randBelow(prompt_list_b.length), 1));
                console.warn(u_prompts_b[u_prompts_b.length - 1]);
            }

        }

        return true;
    }

    /**
     * Displays each player's prompt(s) on the screen.
     * @param {int} n - number of players in lobby
     * @param {boolean} d - if round is a double round
     * @param {boolean} b - if game is using two lists
     */
    function showPrompt(n, d, b) {
        document.getElementById("prompt1").innerHTML = u_prompts[user];

        if (d || b) {
            document.getElementById("prompt2").classList.remove("hide");
            document.getElementById("prompt2").innerHTML = u_prompts_b[user];
        }
    }

    /**
     * Generates a random number between 0 (inclusive) and n (exclusive)
     * @param {int} n - The upper bound for the random number
     */
    function randBelow(n) {
        return Math.floor(Math.random() * n);
    }

