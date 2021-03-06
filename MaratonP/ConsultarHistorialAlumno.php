<!DOCTYPE html>
<?php

/*Este archivo muestra el historial completo a cada alumno
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
<title>Consultar Historial</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js"></script>
<script>
var clave= "";
var grupo= "";
<!-- Funcion AJAX que obtiene los grupos para la materia especifica-->
function ObtieneGrupos(str)
{
	clave= str;
	document.getElementById("Historial").innerHTML="";
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
xmlhttp.open("GET","ObtieneGrupos.php?q="+clave+ "&modo=5",true);
xmlhttp.send();
}

<!-- Funcion AJAX que obtiene el historial para el alumno y materia especifica-->
function ObtieneHistorial(str)
{
	grupo=str;
if (str=="")
  {
  document.getElementById("Historial").innerHTML="";
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
    document.getElementById("Historial").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtieneHistorial.php?clave="+clave+ "&grupo="+grupo+ "&modo=1",true);
xmlhttp.send();
}
</script>
</head>
<body>
<br>
   <?php
   
		
		$resultado=mysqli_query($conexion,"select Clave from clasegrupoalumno where Matricula='$id'");
		
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html");  ?>
            <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">

<table class="CSS_Table_Example" align="center" width="69%" border="">

 
    <tr>
      <td colspan="4" scope="col">Consultar Historial: </td>
    </tr>
    <tr><td>Materia: </td>
      <td><select name="Clave" id="Clave" class="req" onchange="ObtieneGrupos(this.value)">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		$ClaveAl=$row["Clave"];
			$NombreMateria=mysqli_query($conexion,"select * from clase WHERE Clave='$ClaveAl'") or die(mysqli_error());
			$row2=mysqli_fetch_array($NombreMateria);
		print("<option value=".$row["Clave"].">".$row["Clave"]." ".$row2["Nombre"]."</option>");
		}
	?>
	</select><span></span></td>

    </tr>
     <tr><td>Grupo: </td>
      <td><div id="Grupos"></div></td>
    </tr>
     
  
 
</table>

<div id="Historial"></div>

 </div>

            
            <?php
	  
	} 
		
	?>



</body>
</html>

