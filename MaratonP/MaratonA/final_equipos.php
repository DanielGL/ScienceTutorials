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
$equipo=$_GET['equipo'];
$puntaje=$_GET['puntaje'];

$resultado=mysqli_query($conexion,"select matricula from clasegrupoalumno where Clave='$clave' and Grupo='$grupo' and NombreE='$equipo'");

while($row = mysqli_fetch_array($resultado)){
    
    $matricula=$row['matricula'];

    mysqli_query($conexion, "INSERT INTO historial (`Clave`, `Grupo`, `Matricula`, `Fecha`, `Puntaje`) 
VALUES ('$clave','$grupo','$matricula',NOW(),'$puntaje')")or die(mysqli_error());
    
}



// Se cierra la conexion a la base de datos
mysqli_close($conexion);
?>
