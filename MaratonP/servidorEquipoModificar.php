<!DOCTYPE html>
<?php 
 /*Este archivo guarda las modificaciones hechas a algun equipo
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
    <title>Modificar Equipo</title>
    <link rel="stylesheet" href="table.css" type="text/css"/>
    
<link rel="stylesheet" type="text/css" href="Estilos.css">


<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script>
function moveItem( a, b )
{
  var fromBox = document.getElementById( a ),
      toBox = document.getElementById( b );

  for( var i = 0, opts = fromBox.options; opts[ i ]; i++ )
  {
    if( opts[ i ].selected )
    {
      toBox.value = opts[i].value;

      if( toBox.selectedIndex == -1 || ( opts[ i ].text != toBox.options[ toBox.selectedIndex ].text ) )
      {
        toBox.options.add( new Option( opts[i].text, opts[i].value ) );
        opts.remove( i );
        i--;
      }
    }
  }
}
</script>

        
    </head>
    <body>
      <?php
		$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	
$Clave=$_POST["Clave"]; //clave de la materia
$Cantidad=$_POST["Cantidad"]; //cantidad de equipos
$Grupo=$_POST["Grupo"]; //numero de grupo


	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
			?>
          
  <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
  <tr><td colspan="2" scope="col">Equipos: </td></tr>

<?php
if($Cantidad==1){
	$Nombre0=$_POST["Nombre0"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());
	
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	
	}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
 $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}


}

if($Cantidad==2){
		
		$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;
	}
	
	echo"</td></tr>";}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
	
	

}

if($Cantidad==3){

$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
	

	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft2'])){
echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}



if($Cantidad==4){
	
	
	$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());
	
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}

	
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

if($Cantidad==5){

		$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	$Nombre4=$_POST["Nombre4"];
	
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());

$ID4=$_POST["ID4"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID4'")or die(mysqli_error());

	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";

	}
	
		
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft4'])){
	echo "<tr><td>";
	echo $Nombre4;
	echo "</td><td>";
foreach($_POST['namesLeft4'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

if($Cantidad==6){
	$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	$Nombre4=$_POST["Nombre4"];
	$Nombre5=$_POST["Nombre5"];
	
		$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());
$ID4=$_POST["ID4"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID4'")or die(mysqli_error());
$ID5=$_POST["ID5"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre5' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID5'")or die(mysqli_error());
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft4'])){
	echo "<tr><td>";
	echo $Nombre4;
	echo "</td><td>";
foreach($_POST['namesLeft4'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft5'])){
	echo "<tr><td>";
	echo $Nombre5;
	echo "</td><td>";
foreach($_POST['namesLeft5'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre5' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

?>
  
     </table>
 </div>
           


            <?php
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html"); 
			?>
            
  <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
  <tr><td colspan="2" scope="col">Equipos: </td></tr>

<?php
if($Cantidad==1){
	$Nombre0=$_POST["Nombre0"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());
	
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	
	}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
 $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}


}

if($Cantidad==2){
		
		$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;
	}
	
	echo"</td></tr>";}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
	
	

}

if($Cantidad==3){

$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
	

	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft2'])){
echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}



if($Cantidad==4){
	
	
	$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());
	
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}

	
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

if($Cantidad==5){

		$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	$Nombre4=$_POST["Nombre4"];
	
	$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());

$ID4=$_POST["ID4"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID4'")or die(mysqli_error());

	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";

	}
	
		
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft4'])){
	echo "<tr><td>";
	echo $Nombre4;
	echo "</td><td>";
foreach($_POST['namesLeft4'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
  $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

if($Cantidad==6){
	$Nombre0=$_POST["Nombre0"];
	$Nombre1=$_POST["Nombre1"];
	$Nombre2=$_POST["Nombre2"];
	$Nombre3=$_POST["Nombre3"];
	$Nombre4=$_POST["Nombre4"];
	$Nombre5=$_POST["Nombre5"];
	
		$ID0=$_POST["ID0"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID0'")or die(mysqli_error());

$ID1=$_POST["ID1"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID1'")or die(mysqli_error());
$ID2=$_POST["ID2"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID2'")or die(mysqli_error());
$ID3=$_POST["ID3"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID3'")or die(mysqli_error());
$ID4=$_POST["ID4"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID4'")or die(mysqli_error());
$ID5=$_POST["ID5"];
	mysqli_query($conexion, "update equipo
set NombreE='$Nombre5' where Clave='$Clave' AND Grupo ='$Grupo' AND ID='$ID5'")or die(mysqli_error());
	
if(isset($_POST['namesLeft0'])){
	echo "<tr><td>";
	echo $Nombre0;
	echo "</td><td>";
foreach($_POST['namesLeft0'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre0' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft1'])){
	echo "<tr><td>";
	echo $Nombre1;
	echo "</td><td>";
foreach($_POST['namesLeft1'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre1' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft2'])){
	echo "<tr><td>";
	echo $Nombre2;
	echo "</td><td>";
foreach($_POST['namesLeft2'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre2' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft3'])){
	echo "<tr><td>";
	echo $Nombre3;
	echo "</td><td>";
foreach($_POST['namesLeft3'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre3' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft4'])){
	echo "<tr><td>";
	echo $Nombre4;
	echo "</td><td>";
foreach($_POST['namesLeft4'] as $selectedOption){
    $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre4' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	
		
if(isset($_POST['namesLeft5'])){
	echo "<tr><td>";
	echo $Nombre5;
	echo "</td><td>";
foreach($_POST['namesLeft5'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='$Nombre5' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());;}
	
	echo"</td></tr>";
	
	}
	if(isset($_POST['namesRight'])){
	echo "<tr><td>";
	echo "Sin Asignar";
	echo "</td><td>";
foreach($_POST['namesRight'] as $selectedOption){
   $NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$selectedOption'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		echo $row2["Nombre"];
		echo " ";
		echo $row2["ApellidoPaterno"];
		echo " ";
		echo $row2["ApellidoMaterno"];
	echo "<br>";
	mysqli_query($conexion, "update clasegrupoalumno
set NombreE='###' where Clave='$Clave' AND Grupo ='$Grupo' AND Matricula='$selectedOption'")or die(mysqli_error());
	}
	
	echo"</td></tr>";
	
	}
}

?>
  
     </table>
 </div>
           


            <?php
	  
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
?>
    </body>
</html>
