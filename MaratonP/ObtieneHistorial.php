<!DOCTYPE html>
<?php
 /*Este archivo es parte de AJAX y regresa los historiales solicitados
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
if($modo==1){
	$Clave=$_GET['clave'];
	$Grupo=$_GET['grupo'];
	$Total=0;
	$resultado=mysqli_query($conexion,"select * from historial where Clave='$Clave' AND Matricula='$id' AND Grupo='$Grupo'");


echo"<br><div class='CSS_Table_Example' style='width:600px;height:150px;' align='center'>

<table class='CSS_Table_Example' align='center' width='69%' border=''>

 
    <tr>
      <td >Fecha: </td><td >Puntaje: </td>
    </tr>";
	
	while($row=mysqli_fetch_array($resultado)){
		$Total=$Total + $row['Puntaje'];
		echo "<tr><td>".$row['Fecha']."</td><td>".$row['Puntaje']."</td></tr>";
		}
	
	
	echo "<tr><td>Total: </td><td>".$Total."</td></tr></table></div>";

}

else if($modo==2){


echo "<select name='Modo'  class='req' onchange='ObtieneHistorial(this.value)' ><option selected>--</option>";
	
	
		
		echo "<option value='3'>Por Alumno</option>
		<option value='4'>Por Grupo</option>";		
    
	echo "</select>";

}

else if($modo==3){
$Clave=$_GET['clave'];
$Grupo=$_GET['grupo'];
$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' AND Grupo='$Grupo'");
echo "<select name='Matricula' id='Matricula' class='req' onchange='ObtieneHistorialAlumno(this.value)'  ><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		$MatriculaAl=$row["Matricula"];
		$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		print("<option value=".$row["Matricula"].">".$row["Matricula"]." ".$row2["Nombre"]. " ".$row2["ApellidoPaterno"]. " " .$row2["ApellidoMaterno"]."</option>");
		}
    
	echo "</select>";
}

else if($modo==4){
$Clave=$_GET['clave'];
	$Grupo=$_GET['grupo'];
	$resultado=mysqli_query($conexion,"select Matricula,SUM(Puntaje) AS PuntajeTotal from historial where Clave='$Clave' AND Grupo='$Grupo' GROUP BY Clave,Grupo,Matricula");
	
	echo"<br><div class='CSS_Table_Example' style='width:600px;height:150px;' align='center'>

<table class='CSS_Table_Example' align='center' width='69%' border=''>

 
    <tr>
      <td >Matricula: </td><td >Puntaje Total: </td>
    </tr>";
	
	while($row=mysqli_fetch_array($resultado)){
		$MatriculaAl=$row["Matricula"];
			$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
			$row2=mysqli_fetch_array($NombreAlumno);
			echo "<tr><td>";
		echo $row['Matricula'];
		echo " ";
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
		echo "<br>";
		
		echo "</td><td>".$row['PuntajeTotal'];
		echo "</td></tr>";
		}
	
	
	echo "</table></div>";



}

else if($modo==5){
$Clave=$_GET['clave'];
$Grupo=$_GET['grupo'];
$Matricula=$_GET['matricula'];
$Total=0;
$resultado=mysqli_query($conexion,"select * from historial where Clave='$Clave' AND Grupo='$Grupo' AND Matricula='$Matricula'");
echo"<br><div class='CSS_Table_Example' style='width:600px;height:150px;' align='center'>

<table class='CSS_Table_Example' align='center' width='69%' border=''>

 
    <tr>
      <td >Fecha: </td><td >Puntaje: </td>
    </tr>";
	
	while($row=mysqli_fetch_array($resultado)){
		$Total=$Total + $row['Puntaje'];
		echo "<tr><td>".$row['Fecha']."</td><td>".$row['Puntaje']."</td></tr>";
		}
	
	
	echo "<tr><td>Total: </td><td>".$Total."</td></tr></table></div>";
}


mysqli_close($conexion);
?>
</body>
</html>

