<!DOCTYPE html>
<?php
/*Este archivo es parte de AJAX y regresa las preguntas de la materia solicitada
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
	$resultado=mysqli_query($conexion,"select * from pregunta where Clase='$Clave'");
echo "<select name='ID' class='req'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['ID'].">".$row['Descripcion']."</option>";
		}
    
	echo "</select>";
}


else if($modo==2){
	$resultado=mysqli_query($conexion,"select * from pregunta where Clase='$Clave'");
echo "<select name='ID' class='req' onchange='ObtieneDatos(this.value)'><option selected>--</option>";
	
	
		while($row=mysqli_fetch_array($resultado)){
		echo "<option value=".$row['ID'].">".$row['Descripcion']."</option>";
		}
    
	echo "</select>";
}

else if($modo==3){
	$resultado=mysqli_query($conexion,"select * from pregunta where Clase='$Clave'");
echo "<div class='CSS_Table_Example' style='width:600px;height:150px;' align='center'>
<table class='CSS_Table_Example' align='center' width='69%' border=''>
 <tr><td>Descripción: </td><td>Imagen:</td><td>Tema:</td><td>Parcial:</td><td>Dificultad:</td><td>Respuesta Correcta:</td><td>Respuesta Incorrecta 1:</td><td>Respuesta Incorrecta 2:</td><td>Respuesta Incorrecta 3:</td></tr>";
 
 while($row=mysqli_fetch_array($resultado)){
	 
	 if($row["Imagen"]==0){
	 print("<tr><td>".$row["Descripcion"]."</td><td>No hay Imagen</td><td>".$row["Tema"]."</td><td>".$row["Parcial"]."</td><td>".$row["Dificultad"]."</td><td>".$row["Respuesta1"]."</td><td>".$row["Respuesta2"]."</td><td>".$row["Respuesta3"]."</td><td>".$row["Respuesta4"]."</td></tr>");
	 }
	 else{
		  print("<tr><td>".$row["Descripcion"]."</td><td><a href='./MaratonA/upload/".$row["Clase"]."-".$row["ID"].".png' target='_blank' style='text-decoration:none;'>Imagen</a></td><td>".$row["Tema"]."</td><td>".$row["Parcial"]."</td><td>".$row["Dificultad"]."</td><td>".$row["Respuesta1"]."</td><td>".$row["Respuesta2"]."</td><td>".$row["Respuesta3"]."</td><td>".$row["Respuesta4"]."</td></tr>");
		 }
	 
	 
	 }
 
 
echo "</table></div>
";
}

mysqli_close($conexion);
?>
</body>
</html>

