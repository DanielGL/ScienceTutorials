<!DOCTYPE html>
<?php 
/*Este archivo recibe del usuario los datos para crear un maestro, despues envia los datos a servidorMaestro.php
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
	
if (!($conexion=mysql_connect("localhost","root","")))
	{
		echo "Error conectando a la base de datos.";
		exit();
	}
	if (!mysql_select_db("basemaraton",$conexion))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}


	?>
<html>
<head>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
</head>
<body>
<?php
$result=mysql_query("select * from superadmin t WHERE t.ID = '".  $id ."'", $conexion) or die(mysql_error()); 
	$result2=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1", $conexion) or die(mysql_error());
	$result3=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0", $conexion) or die(mysql_error());
	$result4=mysql_query("select * from alumno t WHERE t.Matricula = '".  $id ."'", $conexion) or die(mysql_error());
	
	
		while($row = mysql_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
			?>
            <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <form action="servidorMaestro.php">
    <tr>
      <td colspan="4" scope="col">Datos del nuevo maestro </td>
    </tr>
    <tr><td>Nomina</td>
      <td><input type="text" size="30" class="req" name="Nomina" id="Nomina"></td>

    </tr>
     <tr><td>Nombre</td>
      <td><input type="text" size="30" class="req" name="Nombre" id="Nombre"></td>

    </tr>
     <tr><td>Primer Apellido</td>
      <td><input type="text" size="30" class="req" name="ApellidoP" id="ApellidoP"></td>

    </tr>
     <tr><td>Segundo Apellido</td>
      <td><input type="text" size="30" class="req" name="ApellidoM" id="ApellidoM"></td>

    </tr>
     <tr><td>Administrador?</td>
      <td><select name="Admin" id="Admin" class="req">
	<option selected>--</option>
		
		<option value="0">No</option>
        <option value="1">Si</option>
		
	</select><span></span></td>

    </tr>
    <tr><td></td><td align="right"><input type="submit" value="Crear" class="buttonsDesign"></td></tr>
  </form>
    

 
</table>
</div>
            <?php
	 
	  
	} 
	while($row = mysql_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	  
	 
	} 
	while($row = mysql_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	   
	  
	} 
	while($row = mysql_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	 
	   
	} 
?>


</body>
</html>

