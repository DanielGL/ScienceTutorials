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
$numero=$_GET['numero'];

$i=0;

// Se alamcena todas las preguntas con esa clave
$resultado = mysqli_query($conexion, "select * from equipo where Clave='$clave' and Grupo='$grupo'");

while($i<($numero+1)){
$row = mysqli_fetch_array($resultado);
$i++;
}

$respuesta=$row['NombreE'];

// Se manda un boton que llama a la funcion poner longitud y manda como argumento
// el numero de preguntas
echo $respuesta;

// Se cierra la conexion a la base de datos
mysqli_close($conexion);

?>
