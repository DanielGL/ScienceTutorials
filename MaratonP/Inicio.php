<!DOCTYPE html>
<?php
session_start();
$id=$_SESSION['username'];
if(!isset($_SESSION['username'])){
	
	header("location:index.php");
	
}
	?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link rel="stylesheet" href="table.css" type="text/css"/>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="script.js"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<?php



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
	
	
	$result=mysql_query("select * from superadmin t WHERE t.ID = '".  $id ."'", $conexion) or die(mysql_error()); 
	$result2=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1", $conexion) or die(mysql_error());
	$result3=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0", $conexion) or die(mysql_error());
	$result4=mysql_query("select * from alumno t WHERE t.Matricula = '".  $id ."'", $conexion) or die(mysql_error());
	
	
		while($row = mysql_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   $id=$row["ID"];
	   $contrasenia=$row["Contrasenia"];
	} 
	while($row = mysql_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	   $id=$row["Nomina"];
	   $contrasenia=$row["Contrasenia"];
	} 
	while($row = mysql_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	   $id=$row["Nomina"];
	   $contrasenia=$row["Contrasenia"];
	} 
	while($row = mysql_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	   $id=$row["Matricula"];
	   $contrasenia=$row["Contrasenia"];
	} 
		
?> 
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>

</body> 
</html>
