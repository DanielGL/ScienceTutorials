<!DOCTYPE html>
<?php 

/*Este archivo muestra todas las materias registradas en la base de datos
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
<title>Consultar Materias</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
</head>
<body>
<br>
	<?php
		
		$resultado=mysqli_query($conexion,"select * from clase");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html");  ?>
            <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">Lista de Materias </td>
    </tr>
  
  <tr><td>Clave:</td><td>Nombre:</td> <td>Administrador:</td>
      
      
	<?php
		while($row=mysqli_fetch_array($resultado)){
			$MaestroAux=$row["Administrador"];
			$resultado2=mysqli_query($conexion,"select * from maestro where Nomina='$MaestroAux'");
			$row2=mysqli_fetch_array($resultado2);
		print("<tr><td>".$row["Clave"]."</td>");
		print("<td>".$row["Nombre"]."</td>");
		print("<td>".$row["Administrador"]." ".$row2["Nombre"]." ".$row2["ApellidoPaterno"]. " ".$row2["ApellidoMaterno"]."</td></tr>");
		}
		
		
	?>

    
  
  

 
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

