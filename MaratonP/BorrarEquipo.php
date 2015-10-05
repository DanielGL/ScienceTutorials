<!DOCTYPE html>
<?php

/*Este archivo se encarga de borrar el equipo que le llega como argumento
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
<title>Borrar Equipo</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js"></script>
<script>
var clave="";
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
xmlhttp.open("GET","ObtieneGrupos.php?q="+str+"&modo=4",true);
xmlhttp.send();
}

<!-- Funcion AJAX que obtiene los equipos para el grupo especifico-->
function ObtieneEquipos(str)
{
if (str=="")
  {
  document.getElementById("Equipos").innerHTML="";
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
    document.getElementById("Equipos").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtieneEquipos.php?q="+clave+"&p=" + str+"&modo=1",true);
xmlhttp.send();
}

<!-- Funcion de confirmacion de borrado -->
function confirmar() {
var x;
var r=confirm("Seguro que desea borrar?");
if (r==true)
  {
 if(ValidarForma()){
document.getElementById('BorraEquipo').submit();
}
  }
}

</script>
</head>
<body>
   <?php
   		$resultado=mysqli_query($conexion,"select Clave from grupo where Maestro='$id'");
		
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html");  ?>
            
           
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<form action="servidorEquipoBorrar.php" method="GET" id="BorraEquipo">
<table class="CSS_Table_Example" align="center" width="69%" border="">

 
    <tr>
      <td colspan="4" scope="col">Equipos: </td>
    </tr>
    <tr><td>Clave: </td>
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
    
    <tr><td>Equipo: </td>
      <td><div id="Equipos"></div></td>
    </tr>
      
    <tr><td></td>
 
    <td align="right"><input type="button" class="buttonsDesign" value="Borrar" onClick="confirmar()" /></td>
</tr>
 
</table>
</form>
 </div> 
	  <?php
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html");  ?>
           
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<form action="servidorEquipoBorrar.php" method="GET" id="BorraEquipo">
<table class="CSS_Table_Example" align="center" width="69%" border="">

 
    <tr>
      <td colspan="4" scope="col">Equipos: </td>
    </tr>
    <tr><td>Clave: </td>
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
    
    <tr><td>Equipo: </td>
      <td><div id="Equipos"></div></td>
    </tr>
      
    <tr><td></td>
 
    <td align="right"><input type="button" class="buttonsDesign" value="Borrar" onClick="confirmar()" /></td>
</tr>
 
</table>
</form>
 </div> 
            
	  <?php
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
		
	?>



</body>
</html>

