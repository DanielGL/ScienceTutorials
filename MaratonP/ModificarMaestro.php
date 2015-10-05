<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
/*Este archivo recibe del usuario los datos para modificar un maestro, 
* despues envia los datos a servidorMaestroModificar.php
* Ano de elaboracion: 2013
* Equipo desarrollador:
* Ricardo Molina
* Javier Yepiz
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


<script language="Javascript" type="text/javascript" src="validar.js">
</script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<script>
<!-- Funcion AJAX que obtiene los datos registrados actualmente para el maestro-->
function ObtieneDatos(str)
{
	document.getElementById("Datos").innerHTML="";
if (str=="")
  {
  document.getElementById("Datos").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("Datos").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtieneDatos.php?nomina="+str+"&modo=1",true);
xmlhttp.send();
}
</script>
<title>Modificar Maestro</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>
<?php
$resultado=mysqli_query($conexion,"select * from maestro");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
            <br>
<div id="Datos">
<div class="CSS_Table_Example" style="width:600px;height:87px;" align="center">

<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">Modificar Datos </td>
    </tr>
    <tr><td>Nomina</td>
      <td><select name="Nomina" id="Nomina" class="req" onchange="ObtieneDatos(this.value)">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		print("<option value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
   
  
 
</table>
</div>
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
