<?php

if (isset($_SESSION['cookie1']))
    $id = $_SESSION['cookie1'];
else
    $id = "";

// Se abre la conexion a la base de datoa
$conexion = mysqli_connect("localhost", "root", "", "basemaraton");

if (mysqli_connect_errno($conexion)) {
    echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
}

// Se recibien la variable clave
$clave = $_GET['clave'];
$grupo=$_GET['grupo'];
$matricula=$_GET['matricula'];
$puntaje=$_GET['puntaje'];
$ganador=$_GET['ganador'];

    mysqli_query($conexion, "INSERT INTO historial (`Clave`, `Grupo`, `Matricula`, `Fecha`, `Puntaje`) 
VALUES ('$clave','$grupo','$matricula',NOW(),'$puntaje')")or die(mysqli_error());

// Se manda un boton que llama a la funcion poner longitud y manda como argumento
// el numero de preguntas
    if($ganador==1){
echo "<p class='final'>Felicidades, has ganado esta partida. Muchas gracias por jugar Juego Maratón</p>";
echo "<p class='final'>Tu puntaje final fue de: ".$puntaje." puntos.</p>";
echo "<input type='button' value='Regresar al menú principal' name='regresar' class='regresar' onclick='regesar()'/>";
    }
    else{
        
        echo "<p class='final'>Debes de repasar el material de estudio, has perdido esta partida. Muchas gracias por jugar Juego Maratón</p>";
echo "<p class='final'>Tu puntaje final fue de: ".$puntaje." puntos.</p>";
echo "<input type='button' value='Regresar al menú principal' name='regresar' class='regresar' onclick='regesar()'/>";
    }

// Se cierra la conexion a la base de datos
mysqli_close($conexion);
?>
