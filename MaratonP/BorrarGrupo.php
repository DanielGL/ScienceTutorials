<!DOCTYPE html>
<?php 

/*Este archivo se encarga de borrar el grupo que le llega como argumento
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
?>
<html>
<head>
<title>Borrar Grupo</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">

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

<!-- Funcion de confirmacion de borrado-->
function confirmar() {
var x;
var r=confirm("Seguro que desea borrar?");
if (r==true)
  {
 if(ValidarForma()){
document.getElementById('BorraGrupo').submit();
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
		$resultado=mysqli_query($conexion,"select * from clase");
		$resultado2=mysqli_query($conexion,"select * from maestro");
		$resultado3=mysqli_query($conexion,"select * from grupo");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); ?>
            <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<form action="servidorGrupoBorrar.php" method="GET" id="BorraGrupo">
<table class="CSS_Table_Example" align="center" width="69%" border="">
  
    <tr>
      <td colspan="4" scope="col">Borrar Grupo </td>
    </tr>
  
  <tr><td>Materia:</td>
      <td><select name="Clave" id="Clave" class="req" onchange="ObtieneGrupos(this.value)">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		print("<option value=".$row["Clave"].">".$row["Clave"]. " ".$row["Nombre"]."</option>");
		}
	?>
	</select><span></span></td>
    </tr>
    <tr>
    <td>Grupo:</td>
      <td><div id="Grupos"></div></td>
    
    </tr>
    <tr><td></td><td align="right"><input type="button" class="buttonsDesign" value="Borrar" onClick="confirmar()" /></tr></tr>
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

