/**
 * Author:
 * Date: 9-26-2022
 * 
 */

(function(){
    "use strict";

    var drawing = false;
    var color = "black";
    var line_weight;
    var eraser = false;
    
    var canvas;
    var ctx;
    

    //~~~~~~~~~~~~~~~~~~~~~~~
    //  INITIALIZATION
    //~~~~~~~~~~~~~~~~~~~~~~~
    
    window.addEventListener('load', init);
    
    function init() {
        initCanvas();
        initPalette();
    }

    /**
     * Sets up the canvas's event listeners and scales the canvas.
     */
    function initCanvas() {
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");

        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    
        canvas.addEventListener('mousedown', onMouseDown);
        canvas.addEventListener('mouseup', () => { drawing = false; });
        canvas.addEventListener('mousemove', onMouseMove);

        document.getElementById("done_button").addEventListener('click', finishRound);
    }

    /**
     * Implements the functionality for all the buttons on the palette with event listeners.
     */
    function initPalette() {
        const WEIGHTS = [1.5, 3.0, 4.5];
        const COLORS = ["#000000", "#ffffff", "#ff004d", "#ffa300", "#ffec27", "#00e436", "#29adff", "#065ab5 ", "#800080", "#ff77a8"];

        var pal_elems;
        var i;

        pal_elems = document.querySelectorAll("#pal_weight > .pal_button");
        for(i = 0; i < WEIGHTS.length; i++) {
            let w = WEIGHTS[i];
            pal_elems.item(i).addEventListener('click', () => { line_weight = w; eraser = false; });
        }
        pal_elems.item(WEIGHTS.length).addEventListener('click', () => { eraser = true; })

        pal_elems = document.querySelectorAll("#pal_color > .pal_button");
        for(i = 0; i < pal_elems.length; i++) {
            let c = COLORS[i];
            pal_elems.item(i).addEventListener('click', () => { color = c; eraser = false; });
            pal_elems.item(i).style["background-color"] = c;
        }
    }


    //~~~~~~~~~~~~~~~~~~~~~~~
    //  DRAWING FUNCTIONS
    //~~~~~~~~~~~~~~~~~~~~~~~
    
    /**
     * Starts drawing a line when the user clicks on the canvas. Sets line color, weight, and 
     * handles the eraser.
     * @param {Event} ev
     */
    function onMouseDown(ev) { 
        drawing = true; 
        if (!eraser) {
            ctx.strokeStyle = color;
            ctx.lineWidth = line_weight;
        } else {
            ctx.strokeStyle = "#ffffff";
            ctx.lineWidth = 30.0;
        }
        ctx.beginPath();
        ctx.moveTo(...getMousePos(ev));
    }
    
    /**
     * Draws a line between the user's current mouse position, and the user's last mouse position.
     * @param {Event} ev 
     */
    function onMouseMove(ev) {
        if (!drawing) { return; }
    
        ctx.lineTo(...getMousePos(ev));
        ctx.stroke();
    }
    
    /**
     * Gets the mouse's position within the canvas, centers the cursor on the line's center.
     * Factors in the position on the page, canvas's border, and current line weight.
     * @param {Event} ev 
     */
    function getMousePos(ev) {
        let rect = ev.target.getBoundingClientRect();
        let border = ev.target.style.border + line_weight / 2
        let x = ev.clientX;
        let y = ev.clientY;
        return [x - rect.left - border, y - rect.top - border];
    }


    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //  ROUND FINISH
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  

    function finishRound() {
        canvas.toBlob(exportImg);
    }


    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //  DATABASE FUNCTIONS
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    /**
     * Exports the canvas's content to a png. Temp code until the page connects to a database or the gallery.
     * @param {Blob} blob
     */
    function exportImg(blob) {
        var form_data = new FormData();

        let file_name = `${promptID}.jpg`;
        form_data.append("lid", lobby);
        form_data.append("pid", player);
        form_data.append("user_pic", blob, file_name);
        
        fetch("functions/upload_image.php", {
            method : "POST",
            body: form_data
        }).then(check_status)
            .then(() => { setInterval(check_finished, 2000); });
    }

    /**
     * Checks every few seconds to see if the other players are done.
     * @param {*} response 
     */
    function check_finished() {
        let url = "functions/check_finished.php?lobby=" + lobby;

        fetch(url)
            .then(check_status)
            .then((response) => { 
                if(response["ready"]) { window.location.href = "gallery.php"; }
            });
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