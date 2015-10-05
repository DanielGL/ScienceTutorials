<!DOCTYPE html>
<?php 
 /*Este archivo elimina de un grupo al alumno recibido como argumento
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
    <link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
        
    </head>
    <body>
      <?php		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
$Matricula=$_GET["Matricula"]; //matricula del alumno a borrar
$Numero=$_GET["Numero"]; //Numero de grupo
$Clave=$_GET["Clave"]; // clave de la materia
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); ?>
            <br>
    <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <tr>
      <td colspan="4" scope="col">Alumno Borrado! </td>
    </tr>   
     
            </table>
            </div>
        
<?php


mysqli_query($conexion, "Delete from clasegrupoalumno
where Matricula='$Matricula' AND Grupo = '$Numero' AND Clave='$Clave'")or die(mysqli_error());;


?>


            <?php
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
			?>
            <br>
    <div class="CSS_Table_Example" style="width:600px;height:40px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <tr>
      <td colspan="4" scope="col">Alumno Borrado! </td>
    </tr>   
     
            </table>
            </div>
        
<?php


mysqli_query($conexion, "Delete from clasegrupoalumno
where Matricula='$Matricula' AND Grupo = '$Numero' AND Clave='$Clave'")or die(mysqli_error());;


?>


            <?php
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
		
?>
    </body>
</html>
