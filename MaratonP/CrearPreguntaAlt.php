<!DOCTYPE html>
<?php 
/*Este archivo recibe del usuario los datos para crear una pregunta de forma alterna, ya contando con la clave de la 
* materia
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
<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="table.css" type="text/css"/>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<script language="Javascript" type="text/javascript" src="validar.js">

</script>
<script>

<!-- Funcion que oculta el campo para subir imagenes-->
function ocultarCampoUpload(str)
{

  document.getElementById("CampoUpload").innerHTML="";
  
}

<!-- Funcion AJAX muestra el campo para subir imagenes-->
function mostrarCampoUpload(str)
{
	
if (str=="")
  {
  document.getElementById("CampoUpload").innerHTML="";
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
    document.getElementById("CampoUpload").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ObtieneCampoUpload.php?modo=1",true);
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
	
	$Clave=$_GET["Clave"];
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.php"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
			
			?>
            <div name="tablaInicio" class="CSS_Table_Example" style="width:700px;height:150px;" align="center">
<form action="servidorPregunta.php" method="POST" enctype="multipart/form-data">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">Datos de la nueva pregunta </td>
    </tr>
    <tr><td>Materia</td>
      <td> <?php
		
		print("<input type='hidden' size='20' name='Clave' id='Clave' value=".$Clave.">" .$Clave. "</input>");
	?></td><td></td>

    </tr> 
    <tr><td>Descripci&oacute;n</td>
      <td><textarea rows="5" cols="20" class="req" name="Descripcion" id="Descripcion" wrap="Physical">Escribe aqu&iacute; el contexto de la pregunta</textarea></td><td><div id="CampoUpload"></div></td>

    </tr>
     <tr><td>Tema</td>
      <td><input type="text" size="20" class="req" name="Tema" id="Tema"></td><td></td>

    </tr>
     <tr><td>Parcial</td>
      <td><select name="Parcial" id="Parcial" class="req">
	<option selected>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
	</select></td><td></td>

    </tr>
     <tr><td>Dificultad</td>
      <td><select name="Difficultad" id="Difficultad" class="req">
	<option selected>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
	</select></td><td></td>

  	</tr>
     <tr><td>Respuesta Correcta</td>
      <td><textarea rows="5" cols="20" class="req" name="Respuesta1" id="Respuesta1" wrap="Physical"></textarea></td><td></td>

  	</tr>
     <tr><td>Respuesta Incorrecta 1</td>
      <td><textarea rows="5" cols="20" class="req" name="Respuesta2" id="Respuesta2" wrap="Physical"></textarea></td><td></td>

  	</tr>
     <tr><td>Respuesta Incorrecta 2</td>
      <td><textarea rows="5" cols="20" class="req" name="Respuesta3" id="Respuesta3" wrap="Physical"></textarea></td><td></td>

  	</tr>
     <tr><td>Respuesta Incorrecta 3</td>
      <td><textarea rows="5" cols="20" class="req" name="Respuesta4" id="Respuesta4" wrap="Physical"></textarea></td><td></td>
    </tr>

    </tr>
     <tr><td>Pregunta con Imagen?</td>
      <td>S&iacute;<input type="radio" value="1" name="Imagen" onchange="mostrarCampoUpload(this.value)">
      No<input type="radio" value="0" name="Imagen" onchange="ocultarCampoUpload(this.value)"></td><td></td>
    </tr>

     </tr>
     
   

    <tr><td align="right"></td>  <td></td><td><input type="submit" name="submit" value="Crear" class="buttonsDesign"></td>
</tr>
</table>
</form>
</div>
            <?php
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
		
$Clave=$_GET["Clave"];
?>

</body>
</html>