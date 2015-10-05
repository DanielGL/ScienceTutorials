<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
session_start();
$id=$_SESSION['username'];
if(!isset($_SESSION['username'])){
	
	header("location:index.php");
	
}
?>
<html>
    <head>
    <link rel="stylesheet" href="../table.css" type="text/css"/>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../Estilos.css">
<script language="Javascript" type="text/javascript" src="../validar.js"></script>
<script>
var clave= "";
var grupo= "";
function ObtieneGrupos(str)
{
	 document.getElementById("Iniciar").innerHTML="";
	clave= str;
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
xmlhttp.open("GET","../ObtieneGrupos.php?q="+clave+ "&modo=7",true);
xmlhttp.send();
} 


function ObtieneIniciar(str)
{
grupo= str;
if (str=="")
  {
  document.getElementById("Iniciar").innerHTML="";
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
    document.getElementById("Iniciar").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","../ObtieneValidacionJuego.php?modo=1"+"&clave="+clave+"&grupo="+grupo,true);
xmlhttp.send(); 
}
</script>
        <title>Manda datos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
      <?php
   
		$conexion=mysqli_connect("localhost","root","","basemaraton");
		
		if (mysqli_connect_errno($conexion))
		  {
		  echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
		  }
		$resultado=mysqli_query($conexion,"select Clave from clasegrupoalumno where Matricula='$id'");
		
		
		$resultado=mysqli_query($conexion,"select Clave from clasegrupoalumno where Matricula='$id'");
	?>
    <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">


        <form name="input" action="juego_individual.php" method="GET">
        <table class="CSS_Table_Example" align="center" width="69%" border="">
         <tr>
      <td colspan="4" scope="col">Ingresar Materia: </td>
    </tr>
       <tr> <td>Matricula:</td> <td><input type="hidden" name="matricula" value="<?php echo $id ?>"><?php echo $id ?></input></td></tr>
       <tr> <td>Clave:</td><td><select name="clave" id="clave" class="req" onchange="ObtieneGrupos(this.value)">
	<option selected>--</option>
	<?php
		while($row=mysqli_fetch_array($resultado)){
		$ClaveAl=$row["Clave"];
			$NombreMateria=mysqli_query($conexion,"select * from clase WHERE Clave='$ClaveAl'") or die(mysqli_error());
			$row2=mysqli_fetch_array($NombreMateria);
		print("<option value=".$row["Clave"].">".$row["Clave"]." ".$row2["Nombre"]."</option>");
		}
	?>
	</select><span></span></td></tr>
     <tr><td>Grupo: </td>
      <td><div id="Grupos"></div></td>
    </tr>
     <tr><td>Parcial</td>
      <td><select name="parcial" id="parcial" class="req">
	<option selected>--</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
     <option value=5>Todos</option>
	</select></td>

    </tr>
        <tr>  <td></td><td>
        
       <div id="Iniciar"> </div> 
        
        </td>
        </tr>
        </table> </form>
       </div>
    </body>
</html>