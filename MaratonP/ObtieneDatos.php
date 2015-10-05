<!DOCTYPE html>
<?php
/*Este archivo es parte de AJAX y regresa los datos actuales para modificacion de Maestros, Materias,
* Preguntas
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
$Nomina = $_GET['nomina'];
$resultado=mysqli_query($conexion,"select * from maestro where Nomina='$Nomina'");
$row=mysqli_fetch_array($resultado);
$admin=$row["Administrador"];


echo "
<div class='CSS_Table_Example' style='width:600px;height:150px;' align='center'>
<table class='CSS_Table_Example' align='center' width='69%' border=''>
 <form action='servidorMaestroModificar.php'>
    <tr>
      <td colspan='4' scope='col'>Modificar Datos </td>
    </tr>
    <tr><td>Nomina</td>
      <td><input type='hidden' size='20' name='Nomina' id='Nomina' value=".$Nomina.">" .$Nomina. "</input></td>

    </tr>
     <tr><td>Nombre</td>
      <td><input type='text' size='30' class='req' name='Nombre' id='Nombre' value='" .$row["Nombre"]."'></td>

    </tr>
     <tr><td>Primer Apellido</td>
      <td><input type='text' size='30' class='req' name='ApellidoP' id='ApellidoP' value='" .$row["ApellidoPaterno"]."'></td>

    </tr>
     <tr><td>Segundo Apellido</td>
      <td><input type='text' size='30' class='req' name='ApellidoM' id='ApellidoM' value='".$row["ApellidoMaterno"]."'></td>

    </tr>
     <tr><td>Administrador?</td>
      <td><select name='Admin' id='Admin' class='req'>";
	  if($admin==1){
	echo "<option>--</option>
		
		<option selected value='1'>Si</option>
        <option value='0'>No</option>
		
	</select><span></span>";
	
	}
	else{
		echo "<option>--</option>
		
		<option value='1'>Si</option>
        <option selected value='0'>No</option>
		
	</select><span></span>";
		
		}
	echo "</td>

    </tr>
    <tr><td></td><td align='right'><input type='submit' value='Modificar' class='buttonsDesign'></td>
</tr>
  </form>
   
 
</table>";

}	
else if($modo==2){
	
	$Clave = $_GET['clave'];
$resultado=mysqli_query($conexion,"select * from clase where Clave='$Clave'");
	$resultado2=mysqli_query($conexion,"select * from maestro where administrador=1");
$row=mysqli_fetch_array($resultado);
$admin=$row["Administrador"];

	echo "<table class='CSS_Table_Example' align='center' width='69%' border=''>
 <form action='servidorMateriaModificar.php' >
    <tr>
      <td colspan='4' scope='col'>Modificar Datos </td>
    </tr>
    <tr><td>Clave</td>
      <td><input type='hidden' size='20' name='Clave' id='Clave' value=".$Clave.">" .$Clave. "</input></td>

    </tr>
     <tr><td>Nombre</td>
      <td><input type='text' size='40' class='req' name='Nombre' id='Nombre' value='".$row["Nombre"]."'></td>

    </tr>
    <tr><td>Administrador</td>
      <td><select name='Nomina' id='Nomina' class='req' >
	  <option selected>--</option>
	  ";
	
	
		while($row=mysqli_fetch_array($resultado2)){
			if($row["Nomina"]===$admin){
		echo "<option selected value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>";}
		
		else{echo "<option value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>";}
		}
	
	
	
    echo "
	</select><span></span></td>

    </tr>
   
    <tr><td></td><td align='right'><input type='submit' value='Modificar' class='buttonsDesign'></td> 
</tr>
  </form>
   
 
</table>";
	
	}
	
	else if($modo==3){
		$id = $_GET['id'];
		$clave = $_GET['clave'];
$resultado=mysqli_query($conexion,"select * from pregunta where ID='$id' AND clase='$clave'");
$row=mysqli_fetch_array($resultado);

		echo "<form action='servidorPreguntaModificar.php' method='POST' enctype='multipart/form-data'>
<table class='CSS_Table_Example' align='center' width='59%' border=''>
 
    <tr>
      <td colspan='3' scope='col'>Datos de la pregunta: </td>
    </tr>
	 <tr><td>ID:</td>
      <td><input type='hidden' size='20' name='ID' id='ID' value=".$id.">".$id. "</input></td><td></td>

    </tr> 
    <tr><td>Materia</td>
      <td><input type='hidden' size='20' name='Clave' id='Clave' value=".$row["Clase"].">".$row["Clase"]. "</input></td><td></td>

    </tr> 
    <tr><td>Descripci&oacute;n</td>
      <td><textarea rows='5' cols='20' class='req' name='Descripcion' id='Descripcion' wrap='Physical'>".$row["Descripcion"]."</textarea></td><td><div id='CampoUpload'></div></td>

    </tr>
	 <tr><td>Tema</td>
     
 <td><input type='text' size='40' class='req' name='Tema' id='Tema' value='".$row["Tema"]."'></td><td></td>
    </tr>
	 <tr><td>Parcial</td>
     
 <td><select name='Parcial' id='Parcial' class='req'>"; 
 
   if($row["Parcial"]==1){
	echo "<option>--</option>
    <option selected value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>";
	
	}
	else if($row["Parcial"]==2){
	echo "	<option>--</option>
    <option value=1>1</option>
    <option selected value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>";
		
		}
		
		else if($row["Parcial"]==3){
	echo "	<option>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option selected value=3>3</option>
    <option value=4>4</option>";
		
		}
		
		else if($row["Parcial"]==4){
	echo "	<option>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option selected value=4>4</option>";
		
		}
 
 echo " </select></td><td></td>
    </tr>
	<tr><td>Dificultad</td>
     
 <td><select name='Dificultad' id='Dificultad' class='req'>"; 
 
   if($row["Dificultad"]==1){
	echo "<option>--</option>
    <option selected value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>";
	
	}
	else if($row["Dificultad"]==2){
	echo "	<option>--</option>
    <option value=1>1</option>
    <option selected value=2>2</option>
    <option value=3>3</option>";
		
		}
		
		else if($row["Dificultad"]==3){
	echo "	<option>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option selected value=3>3</option>";
		
		}
		
		
 
 echo " </select></td><td></td>
    </tr>
	
	<tr><td>Respuesta Correcta</td>
     
 <td><textarea rows='5' cols='20' class='req' name='Respuesta1' id='Respuesta1' wrap='Physical'>".$row["Respuesta1"]."</textarea></td><td></td>
    </tr>
	
	<tr><td>Respuesta Incorrecta 1</td>
     
 <td><textarea rows='5' cols='20' class='req' name='Respuesta2' id='Respuesta2' wrap='Physical'>".$row["Respuesta2"]."</textarea></td><td></td>
    </tr>
	
	<tr><td>Respuesta Incorrecta 2</td>
     
 <td><textarea rows='5' cols='20' class='req' name='Respuesta3' id='Respuesta3' wrap='Physical'>".$row["Respuesta3"]."</textarea></td><td></td>
    </tr>
	<tr><td>Respuesta Incorrecta 3</td>
     
 <td><textarea rows='5' cols='20' class='req' name='Respuesta4' id='Respuesta4' wrap='Physical'>".$row["Respuesta4"]."</textarea></td><td></td>
    </tr>
	
	  <tr><td>Modificar Imagen?</td><td>
		
	S&iacute;<input type='radio' value='1' name='Imagen' onchange='mostrarCampoUpload(this.value)'>
      No<input type='radio' value='0' name='Imagen' onchange='ocultarCampoUpload(this.value)' checked='checked'>
	  
	  
	</td><td></td></tr>
	  
	  
	  
	   
	
   
 
   

    <tr><td align='right'></td> <td></td> <td><input type='submit' value='Modificar' class='buttonsDesign'></td>
</tr>
</table>
</form>";
		}
		

mysqli_close($conexion);
?>
</body>
</html>

