<!DOCTYPE html>
<?php 
/*Este archivo recibe del usuario los datos para crear una materia, enviando posteriormente los datos a servidorMateria.php
* 
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
	
	header("location:index.php");}
?>
<html>
<head>
<title>Crear Materia</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
</head>
<body>
<br>
<?php
		$conexion=mysqli_connect("localhost","root","","basemaraton");
		
		if (mysqli_connect_errno($conexion))
		  {
		  echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
		  }
		$resultado=mysqli_query($conexion,"select * from maestro where administrador=1");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
            <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <form action="servidorMateria.php">
    <tr>
      <td colspan="4" scope="col">Datos de la nueva materia: </td>
    </tr>
    <tr><td>Clave: </td>
      <td><input type="text" size="30" class="req" name="Clave" id="Clave"></td>

    </tr>
     <tr><td>Nombre: </td>
      <td><input type="text" size="30" class="req" name="Nombre" id="Nombre"></td>

    </tr>
     <tr><td>Administrador: </td>
      <td><select name="Nomina" id="Nomina" class="req">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		print("<option value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
     
    <tr>  <td></td><td align="right"><input type="submit" value="Crear" class="buttonsDesign"></td>
</tr>
  </form>
  
 
</table>
</div>
            <?php
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
		
		
	?>
    
</body>
</html>

