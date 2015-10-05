<!DOCTYPE html>
<?php
/*Este archivo es parte de AJAX y regresa los equipos para la materia y grupo solicitados
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
$resultado=mysqli_query($conexion,"select * from equipo where Clave='$Clave' AND Grupo='$Grupo'");

if($modo==1){
echo "<select name='ID' class='req'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['ID'].">".$row['NombreE']."</option>";
		}
    
	echo "</select>";

}

else if($modo==2){
echo "<select name='ID' class='req' onchange='ObtieneMiembros(this.value)'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['ID'].">".$row['NombreE']."</option>";
		}
    
	echo "</select>";

}

mysqli_close($conexion);
?>
</body>
</html>

