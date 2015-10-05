<!DOCTYPE html>
<?php 
/*Este archivo modifica en la base de datos los datos de un maestro
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
	$Nomina=$_GET["Nomina"]; //nomina del maestro
$Nombre=$_GET["Nombre"]; //nombre del maestro
$ApellidoP=$_GET["ApellidoP"]; //primer apellido del maestro
$ApellidoM=$_GET["ApellidoM"]; //segundo apellido del maestro
$Admin=$_GET["Admin"]; //permisos de adminsitrador del maestro
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
			$resultado=mysqli_query($conexion,"select count(*) as Cantidad from clase where Administrador='$Nomina'");
$row=mysqli_fetch_array($resultado);
$Cantidad=$row["Cantidad"];

if(($Admin==0 && $Cantidad==0) || $Admin==1){
			?>
            <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
<tr>
      <td colspan="4" scope="col">Nuevos Datos: </td>
    </tr> 
    <tr> 
                <td width="107" align="right">Nomina:</td> 
                <td width="24"><?php echo $Nomina ?></td> 
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
            
             <tr> 
                <td align="right">Privilegios de Administrador?:</td> 
                <td><?php if($Admin==1){
					
					echo "Si";
					}
					
					else{echo "No";}
				
				
				?> </td> 
            </tr>
 
            </table>
            </div>
<?php


mysqli_query($conexion, "update maestro
set Nombre='$Nombre', ApellidoPaterno='$ApellidoP', ApellidoMaterno='$ApellidoM', Administrador='$Admin'
where Nomina='$Nomina'")or die(mysqli_error());   
	} 
	
	else{ ?>
    <br>
		<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">No se le pueden quitar los derechos de administrador al maestro porque es administrador de una o mas materias. Cambiar de administrador las materias que adminsitra este maestro. </td>
    </tr>
</table>
</div>
		 <?php }
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
