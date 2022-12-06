var canvas=document.getElementById('canvas');
var contexto=canvas.getContext('2d');
var rect=canvas.getBoundingClientRect();

var x=0, y=0, dibujando=false, color='black', grosor=10;
canvas.addEventListener('mousedown',function(e){
    x=e.clientX-rect.left;
    y=e.clientY-rect.top;
    dibujando = true;
});

canvas.addEventListener('mousemove', function(e){
    if(dibujando ===true){
        dibujar(x, y, e.clientX-rect.left, e.clientY - rect.top);
        x= e.clientX-rect.left; 
        y=e.clientY.rect.top;
    }
});

canvas.addEventListener('mouseup', function(e){
    if(dibujando===true){
        dibujar(x, y, e.clientX-rect.left, e.clientY - rect.top);
        x=0; y=0; dibujando=false;
    }

});

function dibujar(x1, y1, x2, y2){
    contexto.beginPath();
    contexto.strokeStyle=color;
    contexto.lineWidth=grosor;
    contexto.moveTo(x1, y1);
    contexto.lineTo(x2, y2);
    contexto.stroke();
    contexto.closePath();
}
/*
const $canvas = document.querySelector("#canvas");
const contexto = $canvas.getContext("2d");
const color = "black";
const grosor = 2;
let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
const obtenerXreal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
const obtenerYreal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
let haComenzadoDibujo = false;
$canvas.addEventListener("mousedown", evento => {
    xAnterior = xActual;
    yAnterior = yActual;
    xActual = obtenerXreal(evento.clientX);
    yActual = obtenerYreal(evento.clientY);
    contexto.beginPath();
    contexto.fillStyle = color;
    contexto.fillRect(xActual, yActual, grosor, grosor);
    contexto.closePath();

    haComenzadoDibujo = true;
});


$canvas.addEventListener("mosuemove", (evento)=>{
    if(!haComenzadoDibujo){
        return;
    }

    xAnterior = xActual;
    yAnterior = yActual;
    xActual = obtenerXreal(evento.clientX);
    yActual = obtenerYreal(evento.clientY);
    contexto.beginPath();
    contexto.moveTo(xAnterior, yAnterior);
    contexto.lineTo(xActual, yActual);
    contexto.strokeStyle = color;
    contexto.lineWith= grosor;
    contexto.stroke();
    contexto.closePath();
    
});

["mouseup", "mouseout"].forEach(nombreEvento =>{
    $canvas.addEventListener(nombreEvento, ()=>{
        haComenzadoDibujo = false;
    });
});*/