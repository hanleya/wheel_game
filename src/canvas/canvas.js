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

    function initCanvas() {
        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");

        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    
        canvas.addEventListener('mousedown', onMouseDown);
        canvas.addEventListener('mouseup', () => { drawing = false; });
        canvas.addEventListener('mousemove', onMouseMove);
    }

    function initPalette() {
        const WEIGHTS = [1.5, 3.0, 4.5];
        const COLORS = ["#000000", "#ffffff", "#ff004d", "#ffa300", "#ffec27", "#00e436", "#29adff", "#065ab5 ", "#800080", "#ff77a8"];

        var pal_elems;
        var i;

        pal_elems = document.querySelectorAll("#pal_weight > .pal_button");
        for(i = 0; i < WEIGHTS.length; i++) {
            let w = WEIGHTS[i];
            pal_elems.item(i).addEventListener('click', () => { line_weight = w; });
        }

        pal_elems = document.querySelectorAll("#pal_color > .pal_button");
        for(i = 0; i < pal_elems.length; i++) {
            let c = COLORS[i];
            pal_elems.item(i).addEventListener('click', () => { color = c; });
        }
    }


    //~~~~~~~~~~~~~~~~~~~~~~~
    //  DRAWING FUNCTIONS
    //~~~~~~~~~~~~~~~~~~~~~~~
    
    function onMouseDown(ev) { 
        drawing = true; 
        ctx.strokeStyle = color;
        ctx.lineWidth = line_weight;
        ctx.beginPath();
        ctx.moveTo(...getMousePos(ev));
    }
    
    function onMouseMove(ev) {
        if (!drawing) { return; }
    
        ctx.lineTo(...getMousePos(ev));
        ctx.stroke();
    }
    
    function getMousePos(ev) {
        let rect = ev.target.getBoundingClientRect();
        let x = ev.clientX;
        let y = ev.clientY;
        return [x - rect.left, y - rect.top];
    }


    //~~~~~~~~~~~~~~~~~~~~~~~
    //  PALETTE FUNCTIONS
    //~~~~~~~~~~~~~~~~~~~~~~~

})();