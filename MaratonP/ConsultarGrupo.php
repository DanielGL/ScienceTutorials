<!DOCTYPE html>
<?php 

/*Este archivo muestra todos los grupos registrados en la base de datos
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
<title>Consultar Grupos</title>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
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
</head>
<body>
	<?php
		
		
		$resultado=mysqli_query($conexion,"select * from grupo");
		
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html");  ?>
            
            <br>
<div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">

<table class="CSS_Table_Example" align="center" width="69%" border="">
  
    <tr>
      <td colspan="4" scope="col">Lista de Grupos </td>
    </tr>
  
  <tr><td>Clave:</td><td>Numero de Grupo:</td><td>Maestro:</td></tr>
    
	<?php
		while($row=mysqli_fetch_array($resultado)){
			$MaestroAux=$row["Maestro"];
			$resultado2=mysqli_query($conexion,"select * from maestro where Nomina='$MaestroAux'");
			$row2=mysqli_fetch_array($resultado2);
			$MateriaAux=$row["Clave"];
			$resultado3=mysqli_query($conexion,"select * from clase where Clave='$MateriaAux'");
			$row3=mysqli_fetch_array($resultado3);
		print("<tr><td>".$row["Clave"]." ".$row3["Nombre"]."</td>");
		print("<td>".$row["Numero"]."</td>");
		print("<td>".$row["Maestro"]. " ".$row2["Nombre"]." ".$row2["ApellidoPaterno"]. " ".$row2["ApellidoMaterno"]. "</td></tr>");
		}
	?>
	
   
  
</table>
 
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

