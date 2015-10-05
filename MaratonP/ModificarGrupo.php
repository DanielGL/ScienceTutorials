<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
/*Este archivo recibe del usuario los datos para modificar un grupo, 
* despues envia los datos a servidorGrupoModificar.php
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

<script src="script.js"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
    <script>
    var clave="";
var grupo="";
<!-- Funcion AJAX que obtiene los grupos para la materia especifica-->
function ObtieneGrupos(str)
{
	 clave=str;
if (str=="")
  {
  document.getElementById("Grupos").innerHTML="";
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
    document.getElementById("Grupos").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtieneGrupos.php?q="+clave+"&modo=3",true);
xmlhttp.send();
}


</script>
<title>Modificar Grupo</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>
<?php
$resultado=mysqli_query($conexion,"select * from clase");
		$resultado3=mysqli_query($conexion,"select * from grupo");
		$resultado2=mysqli_query($conexion,"select * from maestro");
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
             <br>
<div class="CSS_Table_Example" style="width:600px;height:160px;" align="center">
 <form action="servidorGrupoModificar.php">
<table class="CSS_Table_Example" align="center" width="69%" border="">

    <tr>
      <td colspan="4" scope="col">Modificar Datos </td>
    </tr>
    <tr><td>Materia: </td>
      <td><select name="Clave" id="Clave" class="req" onchange="ObtieneGrupos(this.value)" >
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		print("<option value=".$row["Clave"].">".$row["Clave"]. " ".$row["Nombre"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
     <tr><td>Grupo: </td>
      <td><div id="Grupos"></div></td>

    </tr>
   
    <tr><td>Maestro</td>
      <td><select name="Nomina" id="Nomina" class="req" >
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado2)){
		print("<option value=".$row["Nomina"].">".$row["Nomina"]." " .$row["Nombre"]. " " .$row["ApellidoPaterno"]. " " .$row["ApellidoMaterno"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
   
    <tr> <td></td><td align="right"><input type="submit" value="Modificar" class="buttonsDesign"></td>
</tr>
  
   
 
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
