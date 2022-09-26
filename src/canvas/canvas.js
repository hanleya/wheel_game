var drawing = false;
var color = "black";
var line_weight;

var curs_off_x = 8;
var curs_off_y = 8;

var canvas;
var ctx;

window.addEventListener('load', init);

function init() {
    canvas = document.getElementById("canvas");
    ctx = canvas.getContext("2d");

    canvas.addEventListener('mousedown', onMouseDown);
    canvas.addEventListener('mouseup', () => { drawing = false; });
    canvas.addEventListener('mousemove', onMouseMove);
}

function onMouseDown(ev) { 
    drawing = true; 
    ctx.strokeStyle = color;
    ctx.beginPath();
    ctx.moveTo(...getMousePos(ev));
}

function onMouseMove(ev) {
    if (!drawing) { return; }

    ctx.lineTo(...getMousePos(ev));
    ctx.stroke();
}

function getMousePos(ev) {
    
}