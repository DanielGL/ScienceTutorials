<?php

if (isset($_SESSION['cookie1']))
    $id = $_SESSION['cookie1'];
else
    $id = "";

// Se abre la conexion a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "basemaraton");

if (mysqli_connect_errno($conexion)) {
    echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
}

// Se reciben las variables clave y siguiente
$clave = $_GET['clave'];
$siguiente = $_GET['sigue'];
$parcial=$_GET['parcial'];

$i=0;// Contador de la pregunta a buscar

if($parcial==5){
$resultado = mysqli_query($conexion, "select * from pregunta where Clase='$clave'");
}
else{
    $resultado = mysqli_query($conexion, "select * from pregunta where Clase='$clave' and Parcial='$parcial'");
}

// Se busca la pregunta
while($i<$siguiente){
$row = mysqli_fetch_array($resultado);
$i++;
}
// Se almacena la dificultad de la pregunta
$nombre = 'upload/'.$row['Clase'].'-'.$row['ID'].'.png';

echo $nombre;

// Se cierra la conexion a la base de datos
mysqli_close($conexion);
?>
