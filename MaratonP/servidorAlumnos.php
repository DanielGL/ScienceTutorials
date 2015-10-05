<!DOCTYPE html>
<?php 
 /*Este archivo inserta en la base de datos a los alumnos recibidos como argumento
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
    <title>Dar de alta Alumnos</title>
    <link rel="stylesheet" href="table.css" type="text/css"/>
    
<link rel="stylesheet" type="text/css" href="Estilos.css">

        
    </head>
    <body>
      <?php
	  
	  
	  
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
$Matriculas=$_GET["Matriculas"]; //matriculas de los alumnos
$Numero=$_GET["Numero"]; //numero de grupo
$Clave=$_GET["Clave"]; //clave de la materia
$Matricula = explode("\n", $Matriculas); //separa las matriculas
$Nombre = "###"; //nombre del alumno por default
$ApellidoP = "###"; //primer apellido del alumno por default
$ApellidoM = "###"; //segundo apellido del alumno por default
$Carrera = "###"; //carrera del alumno por default
$Total = count($Matricula); //total de alumnos a crear
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); ?>
           
       <div class="CSS_Table_Example" style="width:600px;height:40px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <tr>
      <td colspan="4" scope="col">Datos de los alumnos: </td>
    </tr>   
       <?php for ($i = 0; $i < $Total; $i++) { ?>
            <tr> 
                <td align="right">Matricula <?php echo ($i+1) ?>:</td> 
                <td><?php echo $Matricula[$i] ?></td> 
               
            </tr> 
           
            <?php 
			
			
			mysqli_query($conexion, "INSERT IGNORE INTO alumno VALUES ('$Matricula[$i]','$Nombre','$ApellidoP','$ApellidoM','$Carrera', '$Matricula[$i]')")or die(mysqli_error());
			
			mysqli_query($conexion, "INSERT IGNORE INTO clasegrupoalumno VALUES ('$Clave','$Numero','$Matricula[$i]', '###')")or die(mysqli_error());


			
			} ?>
             </table>
            </div>
            
            <?php
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); ?>
              <br>
       <div class="CSS_Table_Example" style="width:600px;height:40px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <tr>
      <td colspan="4" scope="col">Datos de los alumnos: </td>
    </tr>   
       <?php for ($i = 0; $i < $Total; $i++) { ?>
            <tr> 
                <td align="right">Matricula <?php echo ($i+1) ?>:</td> 
                <td><?php echo $Matricula[$i] ?></td> 
               
            </tr> 
           
            <?php 
			
			
			mysqli_query($conexion, "INSERT IGNORE INTO alumno VALUES ('$Matricula[$i]','$Nombre','$ApellidoP','$ApellidoM','$Carrera', '$Matricula[$i]')")or die(mysqli_error());
			
			mysqli_query($conexion, "INSERT IGNORE INTO clasegrupoalumno VALUES ('$Clave','$Numero','$Matricula[$i]', '###')")or die(mysqli_error());


			
			} ?>
             </table>
            </div>
            
            <?php
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
?>
    </body>
</html>
