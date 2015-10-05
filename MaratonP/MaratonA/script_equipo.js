/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var clave;// Variable que almacena la clave de la materia
var grupo;
var parcial;
var numero_equipos;
var longitud;// Variable que almacena el numero de preguntas por materia
var limite;// Variable que almacena el numero de preguntas de una materia
var contesto = "true";// Variable que almacena si ya contesto la pregunta
var primero = "true";// Variable que almacena si es la primer pregunta del juego
var empezado = "false";// Variable que almacena si ya empezo el juego
var robando = "false";
var muestra="true";
var acabar="false";
var ganador;
var albertoright = 90;// Variable que almacena la posicion inicial de alberto
var zombieright = 90;
var danielright = 90;
var alien1right = 90;
var juanitoright = 90;
var alien2right = 90;

var arreglo;// Arreglo que almacena el orden de la preguntas
var orden = new Array(4);// Arreglo que almacena el orden de las respuestas
var equipos;
var puntajes = new Array(6);
var contador = 0;
var robo;

var sigue = 0;// Variable que almacena la siguiente pregunta a desplegar
var sigue_robo;

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

            if (numero_equipos == 2) {

                document.getElementById("alberto").src = "img/aloruns.gif";
                document.getElementById("zombie").src = "img/zombieCamina.gif";
                document.getElementById("puntajesD").innerHTML = "<p id='albertop' class='albertop'></p>\n\
<p id='zombiep' class='zombiep'></p>";
                document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": 0";
                document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": 0";
            }
            else if (numero_equipos == 3) {

                document.getElementById("alberto").src = "img/aloruns.gif";
                document.getElementById("zombie").src = "img/zombieCamina.gif";
                document.getElementById("daniel").src = "img/danielCorre.gif";
                document.getElementById("puntajesD").innerHTML = "<p id='albertop' class='albertop'></p>\n\
<p id='zombiep' class='zombiep'></p>\n\
<p id='danielp' class='danielp'></p>";
                document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": 0";
                document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": 0";
                document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": 0";
            }
            else if (numero_equipos == 4) {

                document.getElementById("alberto").src = "img/aloruns.gif";
                document.getElementById("zombie").src = "img/zombieCamina.gif";
                document.getElementById("daniel").src = "img/danielCorre.gif";
                document.getElementById("alien1").src = "img/alien1Camina.gif";
                document.getElementById("puntajesD").innerHTML = "<p id='albertop' class='albertop'></p>\n\
<p id='zombiep' class='zombiep'></p>\n\
<p id='danielp' class='danielp'></p>\n\
<p id='alien1p' class='alien1p'></p>";
                document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": 0";
                document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": 0";
                document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": 0";
                document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": 0";
            }
            else if (numero_equipos == 5) {

                document.getElementById("alberto").src = "img/aloruns.gif";
                document.getElementById("zombie").src = "img/zombieCamina.gif";
                document.getElementById("daniel").src = "img/danielCorre.gif";
                document.getElementById("alien1").src = "img/alien1Camina.gif";
                document.getElementById("juanito").src = "img/juanitoCorre.gif";
                document.getElementById("puntajesD").innerHTML = "<p id='albertop' class='albertop'></p>\n\
<p id='zombiep' class='zombiep'></p>\n\
<p id='danielp' class='danielp'></p>\n\
<p id='alien1p' class='alien1p'></p>\n\
<p id='juanitop' class='juanitop'></p>";
                document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": 0";
                document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": 0";
                document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": 0";
                document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": 0";
                document.getElementById("juanitop").innerHTML = "Puntaje " + equipos[4] + ": 0";
                
            }
            else if (numero_equipos == 6) {

                document.getElementById("alberto").src = "img/aloruns.gif";
                document.getElementById("zombie").src = "img/zombieCamina.gif";
                document.getElementById("daniel").src = "img/danielCorre.gif";
                document.getElementById("alien1").src = "img/alien1Camina.gif";
                document.getElementById("juanito").src = "img/juanitoCorre.gif";
                document.getElementById("alien2").src = "img/alien2Corre.gif";
                document.getElementById("puntajesD").innerHTML = "<p id='albertop' class='albertop'></p>\n\
<p id='zombiep' class='zombiep'></p>\n\
<p id='danielp' class='danielp'></p>\n\
<p id='alien1p' class='alien1p'></p>\n\
<p id='juanitop' class='juanitop'></p>\n\
<p id='alien2p' class='alien2p'></p>";
                document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": 0";
                document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": 0";
                document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": 0";
                document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": 0";
                document.getElementById("juanitop").innerHTML = "Puntaje " + equipos[4] + ": 0";
                document.getElementById("alien2p").innerHTML = "Puntaje " + equipos[5] + ": 0";
            }

            document.getElementById("puntajesD").style.display="none";
            primero = "false";
        }
        else {

            contador++;
            if (contador == numero_equipos) {
                contador = 0;
            }
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
        xmlhttp.open("GET", "preguntas_equipo.php?c=" + clave +"&parcial="+ parcial + "&grupo=" + grupo + "&contador=" + contador + "&s=" + arreglo[sigue] + "&o1=" + orden[0] + "&o2=" + orden[1] + "&o3=" + orden[2] + "&o4=" + orden[3] + "&nombre=" + equipos[contador], true);
        xmlhttp.send();

        // Obtiene la dificultad de la pregunta que se busco
        $.ajax({
            type: 'GET',
            url: 'dificultad.php',
            async: false,
            data: {clave: clave, pregunta: arreglo[sigue],parcial:parcial},
            success: function(resultado) {
                dificultad = resultado;
            }
        });

        robando = "false";

        sigue_robo = sigue;
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
    xmlhttp.open("GET", "longitud.php?s=" + clave+ "&parcial="+parcial, true);
    xmlhttp.send();
}

//##########################################################################
// Funcion que lee la respuesta seleccionada en la pregunta
// Argumento de entra: Cuanto avansa el sprite en caso de acertar o fallar
function checa(posicion) {

// Se evalua si es la primera vez que se presiona el boton contesto de esa
// pregunta
    if (contesto == "false") {

        var marco = "false";// Variable para saber si contesto alguna opcion
        contesto = "true";

        var radios = document.getElementsByName('respuesta');

        for (var i = 0, length = radios.length; i < length; i++) {
            if ((radios[i].checked) && ((radios[i].value) == "correcta")) {
                marco = "true";// En caso de haber conesttado algo se cambia valor
                correcta(posicion);// En caso de ser correcta se invoca el
                //metodo corecta y se manda como argumento
                //lo que el sprite avanza

            }

        }
        //En caso de no hbaer contesto o haber contestado mal se invoca al
        //metodo incorrecta y se manda lo que el sprite avanza
        if (marco == "false")
            incorrecta(posicion);
    }
}

//#######################################################################
// Funcion que avanza al sprite alberto y actuliza el puntaje
function correcta(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/checkmark.png";

    if (contador == 0) {
        document.getElementById("alberto").style.right = (albertoright - posicion) + "%";
        albertoright = albertoright - posicion;// Se actualiza la posicion
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": " + puntajes[contador];
    }
    else if (contador == 1) {

        document.getElementById("zombie").style.right = (zombieright - posicion) + "%";
        zombieright = zombieright - posicion;
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": " + puntajes[contador];
    }
    else if (contador == 2) {

        document.getElementById("daniel").style.right = (danielright - posicion) + "%";
        danielright = danielright - posicion;
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": " + puntajes[contador];
    }
    else if (contador == 3) {

        document.getElementById("alien1").style.right = (alien1right - posicion) + "%";
        alien1right = alien1right - posicion;
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": " + puntajes[contador];
    }
    else if (contador == 4) {

        document.getElementById("juanito").style.right = (juanitoright - posicion) + "%";
        juanitoright = juanitoright - posicion;
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("juanitop").innerHTML = "Puntaje " + equipos[4] + ": " + puntajes[contador];
    }
    else if (contador == 5) {

        document.getElementById("alien2").style.right = (alien2right - posicion) + "%";
        alien2right = alien2right - posicion;
        puntajes[contador] = puntajes[contador] + posicion;
        document.getElementById("alien2p").innerHTML = "Puntaje " + equipos[5] + ": " + puntajes[contador];
    }



    final();// Se invoca al metodo final
}

//####################################################################
// Funcion que avanza al aprite cocodrilo
function incorrecta(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/wrong.png";
    
    robando = "true";
}

//#####################################################################
//Funcion que se llama al inicio de cada juego
function inicio() {

//Lee las variable que vienen en el URL
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

    $.ajax({
        type: 'GET',
        url: 'numeroe.php',
        async: false,
        data: {clave: clave, grupo: grupo},
        success: function(resultado) {
            numero_equipos = resultado;
        }
    });

    inicio_imagenes();

//Una vez obtenida la clave se manda llamar la funcion para obtener la longitud
    obtienelongitud();
}

//########################################################################
// Funcion que recibe el numero de preguntas y crea el orden de su aparicion
function ponerlongitud(longitud) {
    var c = 0;

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

    equipos = new Array(numero_equipos);

    while (c < numero_equipos) {

        $.ajax({
            type: 'GET',
            url: 'buscaequipos.php',
            async: false,
            data: {clave: clave, grupo: grupo, numero: c},
            success: function(resultado) {
                equipos[c] = resultado;
            }
        });

        puntajes[c] = 0;

        c++;

    }

    obtienepregunta();
}

//#################################################################
// Funcion que evalua si el sprite llego al final de la meta
function final() {
    
    var c=0;

    if (albertoright <= 21) {
        ganador=0;
        acabar="true";
    }
    if (zombieright <= 21) {
        ganador=1;
        acabar="true";
    }
    if (danielright <= 21) {
        ganador=2;
        acabar="true";
    }
    if (alien1right <= 21) {
        ganador=3;
        acabar="true";
    }
    if (juanitoright <= 21) {
        ganador=4;
        acabar="true";
    }
    if (alien2right <= 21) {
        ganador=5;
        acabar="true";
    }
    
    if(acabar=="true"){
        
        while (c < numero_equipos){
            
        $.ajax({
            type: 'GET',
            url: 'final_equipos.php',
            async: false,
            data: {clave: clave, grupo: grupo, equipo:equipos[c], puntaje:puntajes[c]},
            success: function(resultado) {
                
            }
        });
        
        c++;
        
        }
    }
    
    document.getElementById("pregunta").innerHTML = "<p class='final'>La partida a terminado. Muchas gracias por jugar Juego Maratón</p>\n\
    <p class='final'>El equipo ganador es: "+equipos[ganador]+"</p>\n\
    <input type='button' value='Regresar al menú principal' name='regresar' class='regresar' onclick='regesar()'/>";

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
function cancelarjuego() {

    var r = confirm("Si sales perderas todo tu progreso");
    if (r == true) {
        window.location.href = "index.html";
    }
}

function inicio_imagenes() {

    if (numero_equipos == 2) {

        document.getElementById("fondo").innerHTML = "<img src='img/alostands.gif' id='alberto' class='alberto' alt='alberto' />\n\
<img src='img/zombieDefault.gif' id='zombie' class='zombie' alt='zombie' />\n\
<img src='img/ciudad_1.png' alt='fondo' width='100%' />\n\
<div id='puntajesD' class='puntajesD'></div>";
    }
    else if (numero_equipos == 3) {

        document.getElementById("fondo").innerHTML = "<img src='img/alostands.gif' id='alberto' class='alberto' alt='alberto' />\n\
<img src='img/zombieDefault.gif' id='zombie' class='zombie' alt='zombie' />\n\
<img src='img/danielParado.gif' id='daniel' class='daniel' alt='daniel' />\n\
<img src='img/ciudad_1.png' alt='fondo' width='100%' />\n\
<div id='puntajesD' class='puntajesD'></div>";
    }
    else if (numero_equipos == 4) {

        document.getElementById("fondo").innerHTML = "<img src='img/alostands.gif' id='alberto' class='alberto' alt='alberto' />\n\
<img src='img/zombieDefault.gif' id='zombie' class='zombie' alt='zombie' />\n\
<img src='img/danielParado.gif' id='daniel' class='daniel' alt='daniel' />\n\
<img src='img/alien1parado.png' id='alien1' class='alien1' alt='alien1' />\n\
<img src='img/ciudad_1.png' alt='fondo' width='100%' />\n\
<div id='puntajesD' class='puntajesD'></div>";
    }
    else if (numero_equipos == 5) {

        document.getElementById("fondo").innerHTML = "<img src='img/alostands.gif' id='alberto' class='alberto' alt='alberto' />\n\
<img src='img/zombieDefault.gif' id='zombie' class='zombie' alt='zombie' />\n\
<img src='img/juanitoParado.gif' id='juanito' class='juanito' alt='juanito' />\n\
<img src='img/danielParado.gif' id='daniel' class='daniel' alt='daniel' />\n\
<img src='img/alien1parado.png' id='alien1' class='alien1' alt='alien1' />\n\
<img src='img/ciudad_1.png' alt='fondo' width='100%' />\n\
<div id='puntajesD' class='puntajesD'></div>";
    }
    else if (numero_equipos == 6) {
        document.getElementById("fondo").innerHTML = "<img src='img/alostands.gif' id='alberto' class='alberto' alt='alberto' />\n\
<img src='img/zombieDefault.gif' id='zombie' class='zombie' alt='zombie' />\n\
<img src='img/juanitoParado.gif' id='juanito' class='juanito' alt='juanito' />\n\
<img src='img/alien2parado.png' id='alien2' class='alien2' alt='alien2' />\n\
<img src='img/danielParado.gif' id='daniel' class='daniel' alt='daniel' />\n\
<img src='img/alien1parado.png' id='alien1' class='alien1' alt='alien1' />\n\
<img src='img/ciudad_1.png' alt='fondo' width='100%' height='1050 px'/>\n\
<div id='puntajesD' class='puntajesD'></div>";
    }
}

function obtienepreguntas_robo() {

    if (robando == "true") {

        robo = document.getElementById("roba_equipos").value;
        contesto = "false";

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
        xmlhttp.open("GET", "preguntas_robo.php?c=" + clave +"&parcial="+parcial + "&s=" + arreglo[sigue_robo] + "&o1=" + orden[0] + "&o2=" + orden[1] + "&o3=" + orden[2] + "&o4=" + orden[3] + "&nombre=" + equipos[robo], true);
        xmlhttp.send();
}
}

function checa_robo(posicion) {

    // Se evalua si es la primera vez que se presiona el boton contesto de esa
// pregunta
    if (contesto == "false") {

        var marco = "false";// Variable para saber si contesto alguna opcion
        contesto = "true";

        var radios = document.getElementsByName('respuesta');

        for (var i = 0, length = radios.length; i < length; i++) {
            if ((radios[i].checked) && ((radios[i].value) == "correcta")) {
                marco = "true";// En caso de haber conesttado algo se cambia valor
                correcta_robo(posicion);// En caso de ser correcta se invoca el
                //metodo corecta y se manda como argumento
                //lo que el sprite avanza

            }

        }
        //En caso de no hbaer contesto o haber contestado mal se invoca al
        //metodo incorrecta y se manda lo que el sprite avanza
        if (marco == "false")
            incorrecta_robo(posicion);
    }
}

function correcta_robo(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/checkmark.png";

    if (robo == 0) {
        document.getElementById("alberto").style.right = (albertoright - posicion) + "%";
        albertoright = albertoright - posicion;// Se actualiza la posicion
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": " + puntajes[robo];
    }
    else if (robo == 1) {

        document.getElementById("zombie").style.right = (zombieright - posicion) + "%";
        zombieright = zombieright - posicion;
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": " + puntajes[robo];
    }
    else if (robo == 2) {

        document.getElementById("daniel").style.right = (danielright - posicion) + "%";
        danielright = danielright - posicion;
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": " + puntajes[robo];
    }
    else if (robo == 3) {

        document.getElementById("alien1").style.right = (alien1right - posicion) + "%";
        alien1right = alien1right - posicion;
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": " + puntajes[robo];
    }
    else if (robo == 4) {

        document.getElementById("juanito").style.right = (juanitoright - posicion) + "%";
        juanitoright = juanitoright - posicion;
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("juanitop").innerHTML = "Puntaje " + equipos[4] + ": " + puntajes[robo];
    }
    else if (robo == 5) {

        document.getElementById("alien2").style.right = (alien2right - posicion) + "%";
        alien2right = alien2right - posicion;
        puntajes[robo] = puntajes[robo] + posicion;
        document.getElementById("alien2p").innerHTML = "Puntaje " + equipos[5] + ": " + puntajes[robo];
    }



    final();// Se invoca al metodo final
}

//####################################################################
// Funcion que avanza al aprite cocodrilo
function incorrecta_robo(posicion) {

    clearTimeout(t);// Se pone stop al timer
    document.getElementById("resultado").src = "img/wrong.png";

    if (robo == 0) {
        document.getElementById("alberto").style.right = (albertoright + posicion) + "%";
        albertoright = albertoright + posicion;// Se actualiza la posicion
        puntajes[robo] = puntajes[robo] - posicion;
        document.getElementById("albertop").innerHTML = "Puntaje " + equipos[0] + ": " + puntajes[robo];
    }
    else if (robo == 1) {

        document.getElementById("zombie").style.right = (zombieright + posicion) + "%";
        zombieright = zombieright + posicion;
        puntajes[robo] = puntajes[robo] - posicion;
        document.getElementById("zombiep").innerHTML = "Puntaje " + equipos[1] + ": " + puntajes[robo];
    }
    else if (robo == 2) {

        document.getElementById("daniel").style.right = (danielright + posicion) + "%";
        danielright = danielright + posicion;
        puntajes[robo] = puntajes[robo] - posicion;
        document.getElementById("danielp").innerHTML = "Puntaje " + equipos[2] + ": " + puntajes[robo];
    }
    else if (robo == 3) {

        document.getElementById("alien1").style.right = (alien1right + posicion) + "%";
        alien1right = alien1right + posicion;
        puntajes[robo] = puntajes[crobo] - posicion;
        document.getElementById("alien1p").innerHTML = "Puntaje " + equipos[3] + ": " + puntajes[robo];
    }
    else if (robo == 4) {

        document.getElementById("juanito").style.right = (juanitoright + posicion) + "%";
        juanitoright = juanitoright + posicion;
        puntajes[robo] = puntajes[robo] - posicion;
        document.getElementById("juanitop").innerHTML = "Puntaje " + equipos[4] + ": " + puntajes[crobo];
    }
    else if (robo == 5) {

        document.getElementById("alien2").style.right = (alien2right + posicion) + "%";
        alien2right = alien2right + posicion;
        puntajes[robo] = puntajes[robo] - posicion;
        document.getElementById("alien2p").innerHTML = "Puntaje " + equipos[5] + ": " + puntajes[robo];
    }

    final();// Se invoca al metodo final
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
            data: {clave: clave, sigue:arreglo[sigue_robo], parcial:parcial},
            success: function(resultado) {
                nombre = resultado;
            }
        });
    myWindow=window.open(nombre,'WindowC','width=400,height=300');
myWindow.focus();
}