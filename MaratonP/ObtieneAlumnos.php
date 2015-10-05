<!DOCTYPE html>
<?php
/*Este archivo es parte de AJAX y regresa los alumnos inscritos en el grupo solicitado
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

$Clave = $_GET['q'];
$Grupo = $_GET['p'];
$modo = $_GET['modo'];
$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' AND Grupo='$Grupo'");
if($modo==1){
echo "<select name='Matricula' id='Matricula' class='req' ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		$MatriculaAl=$row["Matricula"];
		$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		print("<option value=".$row["Matricula"].">".$row["Matricula"]." ".$row2["Nombre"]. " ".$row2["ApellidoPaterno"]. " " .$row2["ApellidoMaterno"]."</option>");
		}
    
	echo "</select>";
}
else if ($modo==2){
	
		while($row=mysqli_fetch_array($resultado)){
			$MatriculaAl=$row["Matricula"];
			$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
			$row2=mysqli_fetch_array($NombreAlumno);
		echo $row['Matricula'];
		echo " ";
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
		echo "<br>";
		}
	}


mysqli_close($conexion);
?>
</body>
</html>

