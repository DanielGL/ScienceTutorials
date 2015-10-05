/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var clave;// Variable que almacena la clave de la materia
var grupo;
var matricula;
var longitud;// Variable que almacena el numero de preguntas por materia
var parcial;
var limite;// Variable que almacena el numero de preguntas de una materia
var contesto = "true";// Variable que almacena si ya contesto la pregunta
var primero = "true";// Variable que almacena si es la primer pregunta del juego
var empezado = "false";// Variable que almacena si ya empezo el juego
var muestra="true";
var acabar="false";
var ganador;
var albertoright = 90;// Variable que almacena la posicion inicial de alberto
var cocodriloright = 90;// Variable que almacena la posicion inical de cocodrilo

var arreglo;// Arreglo que almacena el orden de la preguntas
var orden = new Array(4);// Arreglo que almacena el orden de las respuestas

var sigue = 0;// Variable que almacena la siguiente pregunta a desplegar
var sigue_imagen;
var puntaje = 0;// Variable que almacena el puntaje de jugador
var nombre;

var posicion;// Variable que almacena cuando avansa el sprite en la pregunta
var dificultad;// Variable que almacena la dificultad de la pregunta

var minuto;// Variable que almacena los minutos del timer
var segundo;// Variable que almacena los segundos del timer
var t;// Variable que almacena el timer

//####################################################################
// Funcion que con AJAX obtiene la siguiente pregunta
function obtienepregunta()
{
    // Evalua si ni hay otra pregunta si contestar y ya haya empezado el juego
    if ((contesto == "true") && (empezado == "true")) {
        contesto = "false";

// Si es la primer pregunta cambio los sprites
        if (primero == "true") {
            document.getElementById("cocodrilo").src = "img/cocoruns.gif";
            document.getElementById("alberto").src = "img/aloruns.gif";
            primero = "false";
        }

// Pone de manera random en el arreglo orden el orden de las respuestas
        for (var k = 0; k < orden.length; k++)
            orden[k] = k + 1;
        for (var i = orden.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = orden[i];
            orden[i] = orden[j];
            orden[j] = temp;
        }

        document.getElementById("pregunta").innerHTML = "";
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("pregunta").innerHTML = xmlhttp.responseText;
            }
        }

        //Manda comoo argumentos la clave, el numero de pregunta y el orden
        xmlhttp.open("GET", "pregunta.php?c=" + clave + "&parcial="+parcial+"&s=" + arreglo[sigue] + "&o1=" + orden[0] + "&o2=" + orden[1] + "&o3=" + orden[2] + "&o4=" + orden[3], true);
        xmlhttp.send();

        // Obtiene la dificultad de la pregunta que se busco
        $.ajax({
            type: 'GET',
            url: 'dificultad.php',
            async: false,
            data: {clave: clave, pregunta: arreglo[sigue], parcial:parcial},
            success: function(resultado) {
                dificultad = resultado;
            }
        });

        sigue_imagen=sigue;
        sigue++; // Se avanza en la pregunta

// En caso que ya no haya mas pereguntas se reinicia el sigue
        if (sigue == limite) {
            sigue = 0;
        }

// Dependiendo de la dificultad se pone los minutos y segundos en el timer
        if (dificultad == 1) {

            minuto = 0;
            segundo = 31;
        }
        else if (dificultad == 2) {

            minuto = 1;
            segundo = 1;
        }
        else if (dificultad == 3) {

            minuto = 2;
            segundo = 1;
        }

// Se arranca el timer
        empieza();
    }

}

//##########################################################################
//Funcion que obtiene la longitud dependiendo de la clave
function obtienelongitud() {

//Se invoca al AJAX
    document.getElementById("pregunta").innerHTML = "";
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("pregunta").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "longitud.php?s=" + clave+"&parcial="+parcial, true);
    xmlhttp.send();
}

//##########################################################################
// Funcion que lee la respuesta seleccionada en la pregunta
// Argumento de entra: Cuanto avansa el sprite en caso de acertar o fallar
function checa(posicion) {

// Se evalua si es la primera vez que se presiona el boton contesto de esa
// pregunta
    if (contesto == "false") {

        var coco = "false";// Variable para saber si contesto alguna opcion
        contesto = "true";

        var radios = document.getElementsByName('respuesta');

        for (var i = 0, length = radios.length; i < length; i++) {
            if ((radios[i].checked) && ((radios[i].value) == "correcta")) {
                coco = "true";// En caso de haber conesttado algo se cambia valor
                correcta(posicion);// En caso de ser correcta se invoca el
                //metodo corecta y se manda como argumento
                //lo que el sprite avanza

            }

        }
        //En caso de no hbaer contesto o haber contestado mal se invoca al
        //metodo incorrecta y se manda lo que el sprite avanza
        if (coco == "false")
            incorrecta(posicion);
    }
}

//#######################################################################
// Funcion que avanza al sprite alberto y actuliza el puntaje
function correcta(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/checkmark.png";
    document.getElementById("alberto").style.right = (albertoright - posicion) + "%";
    albertoright = albertoright - posicion;// Se actualiza la posicion
        puntaje = puntaje + posicion;// Se actuliza el puntaje
    document.getElementById("puntaje").innerHTML = "Puntaje: " + puntaje;

    final();// Se invoca al metodo final
}

//####################################################################
// Funcion que avanza al aprite cocodrilo
function incorrecta(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/wrong.png";
    document.getElementById("cocodrilo").style.right = (cocodriloright - posicion) + "%";
    cocodriloright = cocodriloright - posicion;// Se actiliza la posicion

    final();// Se invoca al metodo final
}

//#####################################################################
//Funcion que se llama al inicio de cada juego
function inicio() {

//Lee las variable que vienen en el URL
var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    matricula = vars["matricula"];

    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    clave = vars["clave"];
    
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    grupo = vars["grupo"];
    
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    parcial = vars["parcial"];
    
    document.getElementById("puntajesD").style.display="none";

//Una vez obtenida la clave se manda llamar la funcion para obtener la longitud
    obtienelongitud();
}

//########################################################################
// Funcion que recibe el numero de preguntas y crea el orden de su aparicion
function ponerlongitud(longitud) {

    empezado = "true";
    arreglo = new Array(longitud);
    limite = longitud;
    for (var k = 0; k < arreglo.length; k++)
        arreglo[k] = k + 1;
    for (var i = arreglo.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = arreglo[i];
        arreglo[i] = arreglo[j];
        arreglo[j] = temp;
    }

    obtienepregunta();
}

//#################################################################
// Funcion que evalua si el sprite llego al final de la meta
function final() {

    if (albertoright <= 21){
        acabar="true";
        ganador=1;
    }
    if (cocodriloright <= 21){
        acabar="true";
        ganador=2;
    }
    
    if(acabar=="true"){
        
        //Se invoca al AJAX
    document.getElementById("pregunta").innerHTML = "";
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("pregunta").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "final_individual.php?clave="+ clave+"&grupo="+grupo+"&matricula="+matricula+"&puntaje="+puntaje+"&ganador="+ganador, true);
    xmlhttp.send();
    }
}

//#################################################################
// Funcion que arranca el timer
function empieza() {

    t = setInterval(function() {
        timer()
    }, 1000);
}

//################################################################
// Funcion que actualiza el timer
function timer() {

    segundo = segundo - 1;// Se resta un segundo

//En caso de llegar al segundo 0
    if (segundo == -1) {
        minuto = minuto - 1;// Se resta un minuto
        segundo = 59;// Se actualiza los segundos
    }

    segundo = ponecero(segundo); //En caso de ser menor de 10 se le agrega un cero
    document.getElementById("timer").innerHTML = minuto + ":" + segundo;

//Si se termina el tiempo
    if ((segundo == 0) && (minuto == 0)) {

        termina();// Se invoca a la funcion termina

        contesto = "true";// Se actualiza contesto para que ya no pueda contestar

// Se invoca incorrecta llevando como argumento lo que avanza cocodrilo
        if (dificultad == 1) {
            incorrecta(2);
        }
        else if (dificultad == 2) {
            incorrecta(4);
        }
        else if (dificultad == 3) {
            incorrecta(6);
        }
    }

//En caso de quedar menos de 10 segundos el timer se pone rojo
    if ((segundo < 10) && (minuto == 0)) {

        document.getElementById("timer").style.color = "red";
    }
}

//###################################################################
// Fucion que pone stop al timer
function termina() {

    clearTimeout(t);
}

//####################################################################
// Funcion que pone cero a un numero
// Argumento de entrada: el numero
function ponecero(i)
{
    if (i < 10)
    {
        i = "0" + i;
    }
    return i;
}

//###################################################################
// Funcion que cancela el juego
function cancelarjuego(){
    
var r=confirm("Si sales perderas todo tu progreso");
if (r==true){
  window.location.href = "index.html";
  }
}

function display_puntajes(){
    
    if(muestra=="false"){
    document.getElementById("puntajesD").style.display="none";
    muestra="true";
    }
    else{
        document.getElementById("puntajesD").style.display="block";
        muestra="false";
    }
}

function ver_imagen(){

$.ajax({
            type: 'GET',
            url: 'imagen.php',
            async: false,
            data: {clave: clave, sigue:arreglo[sigue_imagen], parcial:parcial},
            success: function(resultado) {
                nombre = resultado;
            }
        });
    myWindow=window.open(nombre,'WindowC','width=400,height=300');
myWindow.focus();
}