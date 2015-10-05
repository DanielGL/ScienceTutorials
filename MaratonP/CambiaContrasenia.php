<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
/*Este archivo contiene la funcion de cambio de contrasena, mandando su argumento a ActualizaContrasena.php
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
<!--importacion de hojas de estilo -->
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link rel="stylesheet" href="table.css" type="text/css"/>

<!--importacion de scripts -->
<script src="script.js"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>

<?php



	
	
	
	$result=mysql_query("select * from superadmin t WHERE t.ID = '".  $id ."'", $conexion) or die(mysql_error()); 
	$result2=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1", $conexion) or die(mysql_error());
	$result3=mysql_query("select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0", $conexion) or die(mysql_error());
	$result4=mysql_query("select * from alumno t WHERE t.Matricula = '".  $id ."'", $conexion) or die(mysql_error());
	
	
		while($row = mysql_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   $id=$row["ID"];
	   
	} 
	while($row = mysql_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	   $id=$row["Nomina"];
	  
	} 
	while($row = mysql_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	   $id=$row["Nomina"];
	  
	} 
	while($row = mysql_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	   $id=$row["Matricula"];
	  
	} 
		
?> 
<script>

function verificaContrasenia() {

var contrasenia1 = document.getElementById("contrasenia").value;
var contrasenia2 = document.getElementById("contraseniaAux").value;




if(contrasenia1==contrasenia2){
if(ValidarForma()){
document.getElementById('cambiaContrasenia').submit();
}
}

else{
document.getElementById("contrasenia").className= "invalid";
document.getElementById("contraseniaAux").className= "invalid";
}


}

</script>
<title>Cambia contrasena</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>
<br>
<div id="Datos">
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
 <table class="CSS_Table_Example" align="center" width="69%" border="">
<form action="ActualizaContrasenia.php" method="get" id="cambiaContrasenia">
 <tr>
      <td colspan="4" scope="col">Cambiar Contrasena: </td>
    </tr>
  <tr><td>Usuario: </td>
      <td>
					<input type="text"value="<?php echo $id ?>" disabled />
					<input type="hidden" name="id" value="<?php echo $id ?>"  />
				</td>
    </tr>
     
       <tr><td>Contrasena Anterior: </td>
    <td><input class="req" type="password" name="contraseniaA" id="contraseniaA" value="" /></td>

    </tr>
       <tr><td>Nueva Contrasena (9 caracteres max): </td>
    <td><input class="req" type="password" name="contrasenia" id="contrasenia" value="" /></td>

    </tr>
       <tr><td>Confirmar Contrasena: </td>
    <td><input class="req" type="password" name="contraseniaAux" id="contraseniaAux" value=""/></td>

    </tr>
    
    <tr>
    <td></td><td align="right"><input type="button" class="buttonsDesign" value="Cambiar" onClick="verificaContrasenia()" /></td>
    </tr>
</form>

</table>
</div>
</div>
</body> 
</html>
