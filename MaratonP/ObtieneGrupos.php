<!DOCTYPE html>
<?php 
 /*Este archivo es parte de AJAX y regresa los grupos para la materia ingresada
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
$modo = $_GET['modo'];



if($modo==1){
	$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave' AND Maestro='$id'");
echo "<select name='Numero' class='req'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";

}

else if ($modo==2){
	$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave' AND Maestro='$id'");
	echo "<select name='Numero'  class='req' onchange='ObtieneAlumnos(this.value)' ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";}
	
	else if ($modo==3){
		$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave'");
	echo "<select name='Numero'  class='req'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";}
	
	else if ($modo==4){
		$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave' AND Maestro='$id'");
	echo "<select name='Numero'  class='req' onchange='ObtieneEquipos(this.value)' ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";}
	
	else if ($modo==5){
		$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' AND Matricula='$id'");
		echo "<select name='Numero'  class='req' onchange='ObtieneHistorial(this.value)' ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Grupo'].">".$row['Grupo']."</option>";
		}
    
	echo "</select>";
		}
		
		else if ($modo==6){
		$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave' AND Maestro='$id'");
		echo "<select name='Numero'  class='req' onchange='ObtieneModoHistorial(this.value)' ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";
		}
		
		else if ($modo==7){
		$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' AND Matricula='$id'");
		echo "<select name='grupo'  class='req' onchange='ObtieneIniciar(this.value)'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Grupo'].">".$row['Grupo']."</option>";
		}
    
	echo "</select>";
		}
		
		else if ($modo==8){
		$resultado=mysqli_query($conexion,"select * from grupo where Clave='$Clave' AND Maestro='$id'");
		echo "<select name='grupo'  class='req' onchange='ObtieneIniciar(this.value)'><option selected>--</option>";
	
	
		
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['Numero'].">".$row['Numero']."</option>";
		}
    
	echo "</select>";
		}

mysqli_close($conexion);
?>
</body>
</html>

