<!DOCTYPE html>
<?php 
 /*Este archivo guarda las modificaciones a los datos de un alumno
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
	$Matricula=$_GET["Matricula"]; //matricula del alumno
$Nombre=$_GET["Nombre"]; //nuevo nombre del alumno
$ApellidoP=$_GET["ApellidoP"]; //nuevo primer apellido del alumno
$ApellidoM=$_GET["ApellidoM"]; //nuevo segundo apellido del alumno
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html");  ?>
              <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
<tr>
      <td colspan="4" scope="col">Nuevos Datos: </td>
    </tr> 
    <tr> 
                <td width="107" align="right">Matricula:</td> 
                <td width="24"><?php echo $Matricula ?></td> 
            </tr> 
            <tr> 
                <td align="right">Nombre:</td> 
                <td><?php echo $Nombre ?></td> 
            </tr> 
            <tr> 
                <td align="right">Primer Apellido:</td> 
                <td><?php echo $ApellidoP ?></td> 
            </tr> 
            <tr> 
                <td align="right">SegundoApellido:</td> 
                <td><?php echo $ApellidoM ?></td> 
            </tr> 
            
            
 
            </table>
            </div>
<?php


mysqli_query($conexion, "update alumno
set Nombre='$Nombre', ApellidoPaterno='$ApellidoP', ApellidoMaterno='$ApellidoM'
where Matricula='$Matricula'")or die(mysqli_error());
	  
	} 
?>


    </body>
</html>
