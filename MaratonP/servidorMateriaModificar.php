<!DOCTYPE html>
<?php 
/*Este archivo modifica en la base de datos los datos de una materia
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

        
    </head>
    <body>
  
<?php	
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	$Clave=$_GET["Clave"]; //clave de la materia
$Nombre=$_GET["Nombre"]; //nombre de la materia
$Nomina=$_GET["Nomina"]; //administrador de la materia
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
            <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
   <tr>
      <td colspan="4" scope="col">Nuevos Datos: </td>
    </tr> 
    <tr> 
                <td width="107" align="right">Clave:</td> 
                <td width="24"><?php echo $Clave ?></td> 
            </tr> 
            <tr> 
                <td align="right">Nombre:</td> 
                <td><?php echo $Nombre ?></td> 
            </tr> 
            <tr> 
                <td align="right">Nomina:</td> 
                <td><?php echo $Nomina ?></td> 
            </tr> 
          
            
 
            </table>
            </div>
<?php


mysqli_query($conexion, "update clase
set Nombre='$Nombre', Administrador='$Nomina'
where Clave='$Clave'")or die(mysqli_error());;   
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
