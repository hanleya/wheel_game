
var drawing = false;
var color = "black";
var line_weight;

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

function onMouseDown() { 
    drawing = true; 
    ctx.strokeStyle = color;
    ctx.beginPath();
    ctx.moveTo(ev.layerX - 8,  ev.layerY - 8);
}

function onMouseMove(ev) {
    if (!drawing) { return; }

    ctx.lineTo(ev.layerX - 8, ev.layerY - 8);
    ctx.stroke();
}