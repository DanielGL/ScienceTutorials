<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
/*Este archivo recibe del usuario los datos para modificar un alumno, 
* despues envia los datos a servidorAlumnoModificar.php
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
		  echo "No se pudo conectar a la base de datos: " . mysqli_connect_error();
		  }
?>
<html>
<head>
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="script.js"></script>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<title>Modificar Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>
<?php
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
			include("MenuAlumno.html"); 
				$resultado=mysqli_query($conexion,"select * from alumno where Matricula = '$id'");
		$row=mysqli_fetch_array($resultado);
			?>
            <br>
<form action="ServidorAlumnoModificar.php" method="GET">
<div class="CSS_Table_Example" style="width:600px;height:87px;" align="center">

<table class="CSS_Table_Example" align="center" width="69%" border="">
 
    <tr>
      <td colspan="4" scope="col">Modificar Datos </td>
    </tr>
    <tr><td>Matricula: </td>
      <td><input type="hidden" size="30" class="req" name="Matricula" id="Matricula" value="<?php echo $id ?>"><?php echo $id ?></input></td>

    </tr>
    
    <tr><td>Nombre: </td> 
      <td>
      <?php if($row["Nombre"]=="###"){?>
     <input type="text" size="30" class="req" name="Nombre" id="Nombre" value="<?php echo $row["Nombre"] ?>">
      <?php } else{?>
       <input type="hidden" size="30" class="req" name="Nombre" id="Nombre" value="<?php echo $row["Nombre"] ?>"><?php echo $row["Nombre"] ?></input>
      
      
      <?php }?>
      </td>

    </tr>
    
    <tr><td>Primer Apellido: </td>
      <td> <?php if($row["ApellidoPaterno"]=="###"){?>
     <input type="text" size="30" class="req" name="ApellidoP" id="ApellidoP" value="<?php echo $row["ApellidoPaterno"] ?>">
      <?php } else{?>
       <input type="hidden" size="30" class="req" name="ApellidoP" id="ApellidoP" value="<?php echo $row["ApellidoPaterno"] ?>"><?php echo $row["ApellidoPaterno"] ?></input>
      
      
      <?php }?></td>

    </tr>
    
      <tr><td>Segundo Apellido: </td>
      <td><?php if($row["ApellidoMaterno"]=="###"){?>
     <input type="text" size="30" class="req" name="ApellidoM" id="ApellidoM" value="<?php echo $row["ApellidoMaterno"] ?>">
      <?php } else{?>
       <input type="hidden" size="30" class="req" name="ApellidoM" id="ApellidoM" value="<?php echo $row["ApellidoMaterno"] ?>"><?php echo $row["ApellidoMaterno"] ?></input>
      
      
      <?php }?></td>

    </tr>
     <tr>
    <td></td>
    <?php if((($row["Nombre"]=="###")||$row["ApellidoPaterno"]=="###")||($row["ApellidoMaterno"]=="###")){?>
    <td align="right"><input type="submit" value="Cambiar" class="buttonsDesign"></td>
    <?php }else{?>
    <td></td>
    <?php }?>
    
    </tr>
     
    
   
  
 
</table>
</div>
</form>
            <?php
	  
	} 
	
	
?>



</body> 
</html>
