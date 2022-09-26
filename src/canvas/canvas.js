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
    let rect = ev.target.getBoundingClientRect();
    let x = ev.clientX;
    let y = ev.clientY;
    return [x - rect.left, y - rect.top];
}