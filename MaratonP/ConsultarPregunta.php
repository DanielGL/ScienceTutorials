<!DOCTYPE html>
<?php 

/*Este archivo muestra las preguntas registradas para cada materia
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
<title>Consultar Preguntas</title>

<link rel="stylesheet" href="table.css" type="text/css"/>

<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js">

</script>
<script>
<!-- Funcion AJAX que obtiene las preguntas para la materia especifica-->
function ObtienePreguntas(str)
{
if (str=="")
  {
  document.getElementById("Preguntas").innerHTML="";
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
    document.getElementById("Preguntas").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtienePreguntas.php?q="+str+"&modo=3",true);
xmlhttp.send();
}



</script>
</head>
<body>
<?php
$resultado=mysqli_query($conexion,"select Clave from clase where Administrador='$id'");
$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.php"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html");  ?>
        
<div name="tablaInicio" class="CSS_Table_Example" style="width:600px;height:85px;" align="center">
<form action="servidorPreguntaBorrar.php" method="GET" id="BorraPregunta">
<table class='CSS_Table_Example' align='center' width='69%' border=''>
 
    <tr>
      <td colspan="4" scope="col">Descripcion de la pregunta </td>
    </tr>
    <tr><td>Materia: </td>
      <td><select name="Clave" id="Clave" class="req" onchange="ObtienePreguntas(this.value)">
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
</table>
</form>
</div>
<br>
<div id="Preguntas"></div>
            
            <?php
	  
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