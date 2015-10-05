<!DOCTYPE html>
<?php 
/*Este archivo borra de la base de datos al maestro recibido como argumento
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
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link rel="stylesheet" href="table.css" type="text/css"/>

        
    </head>
    <body>

    <br>
      <?php
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	$Nomina=$_GET["Nomina"]; //nomina del maestro
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html");  
			$resultado=mysqli_query($conexion,"select count(*) as Cantidad from clase where Administrador='$Nomina'");
$row=mysqli_fetch_array($resultado);
$Cantidad=$row["Cantidad"];

	$resultado2=mysqli_query($conexion,"select count(*) as Cantidad from grupo where Maestro='$Nomina'");
$row2=mysqli_fetch_array($resultado2);
$Cantidad2=$row["Cantidad"];


if($Cantidad==0 && $Cantidad2==0){
			?>
            <br>
  <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">Maestro Borrado! </td>
    </tr>
</table>
</div>
<?php


mysqli_query($conexion, "Delete from maestro
where Nomina = '$Nomina'")or die(mysqli_error());
}

else if($Cantidad >0 && $Cantidad2==0){ ?>
	<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">No se puede borrar el maestro porque es administrador de una materia. Cambiar de administrador a las materias que tienen al maestro como administrador </td>
    </tr>
</table>
</div>
	
    <?php
    }
	
	else if($Cantidad ==0 && $Cantidad2>0){ ?>
	<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">No se puede borrar el maestro porque es maestro de un grupo. Cambiar de maestro a los grupos que lo tienen como maestro. </td>
    </tr>
</table>
</div>
	
    <?php
    }
	
		else if($Cantidad > 0 && $Cantidad2>0){ ?>
	<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">No se puede borrar el maestro porque es maestro de un grupo. Cambiar de maestro a los grupos que tienen al maestro como administrador. <br> <br> No se puede borrar el maestro porque es maestro de un grupo. Cambiar de maestro a los grupos que lo tienen como maestro.</td>
    </tr>
</table>
</div>
	
    <?php
    }
	
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
