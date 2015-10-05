
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php

/*Este archivo se encarga de actualizar a nueva contrasena en caso de modificacion
* Ano de elaboracion: 2013
* Equipo desarrollador:
* Ricardo Molina
* Javier Yepiz
* Daniel Garza
* Erasmo Leal
* 
*/


session_start(); //inicia la sesion
$id=$_SESSION['username']; //obtiene el id de la sesion activa
if(!isset($_SESSION['username'])){
	
	header("location:index.php"); //en caso de que no se haya iniciado sesion redirecciona a la pagina de login
	
	//se valida conexion hacia la base de datos
	if (!($conexion=mysql_connect("localhost","root","")))
	{
		echo "Error conectando a la base de datos.";
		exit();
	}
	//se valida que la base de datos exista
	if (!mysql_select_db("basemaraton",$conexion))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}
	
}
	?>
<html>


<head>
<!--importacion de hojas de estilo -->
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link rel="stylesheet" href="table.css" type="text/css"/>

<!--importacion de scripts -->
<script src="script.js"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>

<?php

  

	
	
	//se seleccioann todos los usuarios para obtener el tipo de usuario
	$result=mysql_query("select * from superadmin t WHERE t.ID = '".  $id ."'", $conexion) or die(mysql_error()); 
	$result2=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1", $conexion) or die(mysql_error());
	$result3=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0", $conexion) or die(mysql_error());
	$result4=mysql_query("select * from alumno t WHERE t.Matricula = '".  $id ."'", $conexion) or die(mysql_error());
	
	//checa si es un administrador
		while($row = mysql_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
			$tipo=1;
			$contraseniaB= $row["Contrasenia"]; //obtiene contrasena anterior almacenada en la base de datos
	  
	} 
	//checa si es un maestro administrador
	while($row = mysql_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
			$tipo=2;
			$contraseniaB= $row["Contrasenia"]; //obtiene contrasena anterior almacenada en la base de datos
	   
	} 
	//checa si es un maestro
	while($row = mysql_fetch_array($result3)) {
			include("MenuMaestro.html"); 
			$tipo=3;
			$contraseniaB= $row["Contrasenia"]; //obtiene contrasena anterior almacenada en la base de datos
	  
	} 
	//checa si es un alumno
	while($row = mysql_fetch_array($result4)) {
			include("MenuAlumno.html"); 
			$tipo=4;
			$contraseniaB= $row["Contrasenia"]; //obtiene contrasena anterior almacenada en la base de datos
	  
	} 
	
	$contrasenia=$_GET["contrasenia"]; //variable que recibe la nueva contrasena
	$contraseniaA=$_GET["contraseniaA"]; //variable que recibe la contrasena anterior
		
		
?> 

<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>
<br>
<?php 
// verifica si la contrasena anterior dada es igual a la almacenada en la base de datos
if($contraseniaA==$contraseniaB){ 

?>

<!--Tabla que muestra mensaje de cambio de contrasena exitoso -->
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
 <table class="CSS_Table_Example" align="center" width="69%" border="">

 <tr>
      <td colspan="4" scope="col">Se cambio la contrase&ntildea ! </td>
    </tr>
   
   
 

</table>
</div>





	<?php
	//dependiendo del tipo de usuario, actualiza la contrasena en la base de datos
	if($tipo==1){
	mysql_query("UPDATE superadmin SET Contrasenia = '$contrasenia' WHERE ID = '$id'",$conexion)or die(mysql_error()); 
	}
	else if($tipo==2){
	mysql_query("UPDATE maestro SET Contrasenia = '$contrasenia' WHERE Nomina = '$id'",$conexion)or die(mysql_error()); 
	}
	else if($tipo==3){
	mysql_query("UPDATE maestro SET Contrasenia = '$contrasenia' WHERE Nomina = '$id'",$conexion)or die(mysql_error()); 
	}
	else if($tipo==4){
	mysql_query("UPDATE alumno SET Contrasenia = '$contrasenia' WHERE Matricula = '$id'",$conexion)or die(mysql_error()); 
	}
		}
		
		//en caso que la contrasena anterior dada no sea igual a la almacenada en la base de datos
		else{ ?> 
        
        <!--Tabla que muestra mensaje de cambio de contrasena NO exitoso -->

		<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
 <table class="CSS_Table_Example" align="center" width="69%" border="">

 <tr>
      <td colspan="4" scope="col">Contrase&ntildea anterior incorrecta! </td>
    </tr>
   
   
 

</table>
</div>
		<?php }
	?>
</body> 
</html>



	
  
  