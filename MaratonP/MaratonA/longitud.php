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
$clave = $_GET['s'];
$parcial=$_GET['parcial'];


if($parcial==5){
// Se alamcena todas las preguntas con esa clave
$resultado = mysqli_query($conexion, "select count(*) as Longitud from pregunta where Clase='$clave'");
}
else{
    $resultado = mysqli_query($conexion, "select count(*) as Longitud from pregunta where Clase='$clave' and Parcial='$parcial'");
}

$row = mysqli_fetch_array($resultado);

// Se manda un boton que llama a la funcion poner longitud y manda como argumento
// el numero de preguntas
echo "<input type='button' value='Empezar Juego' name='empezar' class='empezar' onclick='ponerlongitud(" . $row['Longitud'] . ")'/>";

// Se cierra la conexion a la base de datos
mysqli_close($conexion);
?>
