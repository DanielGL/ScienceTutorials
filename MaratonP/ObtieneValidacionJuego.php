<!DOCTYPE html>
<?php
/*Este archivo es parte de AJAX y valida que exista mas de una pregunta y mas de dos
* equipos para juego en equipos
* Año de elaboración: 2013
* Equipo desarrollador:
* Ricardo Molina
* Javier Yépiz
* Daniel Garza
* Erasmo Leal
* 
*/
session_start();
$id=$_SESSION['username'];
if(!isset($_SESSION['username'])){
	
	header("location:index.php");
	
}
$conexion=mysqli_connect("localhost","root","","basemaraton");
		
		if (mysqli_connect_errno($conexion))
		  {
		  echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
		  }
?>
<html>
<head>
</head>
<body>

<?php

$modo = $_GET['modo'];
$clave = $_GET['clave'];
$grupo = $_GET['grupo'];


if($modo==1){
	$resultado=mysqli_query($conexion,"select count(*) as Cantidad from pregunta where Clase='$clave'");
$row=mysqli_fetch_array($resultado);
$Cantidad=$row["Cantidad"];



if($Cantidad>0){
	echo "<input class='buttonsDesign' type='submit' value='Jugar'>";
	}
	
	else{
		echo "No hay preguntas para esta materia !";
		}
		
		

}

if($modo==2){
	$resultado=mysqli_query($conexion,"select count(*) as Cantidad from pregunta where Clase='$clave'");
$row=mysqli_fetch_array($resultado);
$Cantidad=$row["Cantidad"];

$resultado2=mysqli_query($conexion,"select count(*) as Cantidad from equipo where Clave='$clave' && Grupo='$grupo'");
$row2=mysqli_fetch_array($resultado2);
$Cantidad2=$row2["Cantidad"];



if($Cantidad>0 &&$Cantidad2>=2){
	echo "<input class='buttonsDesign' type='submit' value='Jugar'>";
	}
	
	else if($Cantidad==0 &&$Cantidad2>=2){
		echo "La materia no tiene preguntas registradas !";
		}
		
		else if($Cantidad>0 &&$Cantidad2<2){
		echo "La materia necesita tener minimo 2 equipos !";
		}
		
		else{
			echo "La materia no tiene preguntas registradas y necesita minimo 2 equipos !";
			}
		
		

}





mysqli_close($conexion);
?>
</body>
</html>

