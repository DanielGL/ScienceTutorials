<!DOCTYPE html>
<?php 
session_start();
$id=$_SESSION['username'];
if(!isset($_SESSION['username'])){
	
	header("location:index.php");
	
	/*Este archivo se encarga de borrar el maestro que le llega como argumento
* Año de elaboración: 2013
* Equipo desarrollador:
* Ricardo Molina
* Javier Yépiz
* Daniel Garza
* Erasmo Leal
* 
*/
	
}
?>
<html>
<head>
<title>Borrar Maestro</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
<script>
<!-- Funcion de confirmacion de borrado-->
function confirmar() {
var x;
var r=confirm("Seguro que desea borrar?");
if (r==true)
  {
 if(ValidarForma()){
document.getElementById('BorraMaestro').submit();
}
  }
}
</script>

</head>
<body>
	<?php
		$conexion=mysqli_connect("localhost","root","","basemaraton");
		
		if (mysqli_connect_errno($conexion))
		  {
		  echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
		  }
		
		$resultado=mysqli_query($conexion,"select * from maestro");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
            <br>
<div class="CSS_Table_Example" style="width:600px;height:100px;" align="center">
<form action="servidorMaestroBorrar.php" method="GET" id="BorraMaestro">
<table class="CSS_Table_Example" align="center" width="69%" border="">
  
    <tr>
      <td colspan="4" scope="col">Borrar Maestro </td>
    </tr>
  
   <tr><td>Nomina: </td>
      <td><select name="Nomina" id="Nomina" class="req">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		print("<option value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
    
    <tr><td></td><td align="right"><input type="button" class="buttonsDesign" value="Borrar" onClick="confirmar()" /></td></tr>

</table>
  </form>
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

