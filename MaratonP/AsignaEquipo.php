<!DOCTYPE html>
<html>
  <?php 
  
  /*Este archivo es donde se pueden asignar equipos
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
		  
$Clave=$_GET["Clave"];
$Grupo=$_GET["Numero"];
$Cantidad= $_GET["Cantidad"];
$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' and Grupo='$Grupo' and NombreE='###'");
	
	?>
    <head>
  <title>Crear Equipo</title>
    <link rel="stylesheet" href="table.css" type="text/css"/>
    
<link rel="stylesheet" type="text/css" href="Estilos.css">

<script language="Javascript" type="text/javascript" src="validar.js"></script>
<script type="text/javascript" language="javascript">
<!-- Funcion para mover alumnos de izquiera a derecha -->
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

<!-- Funcion para mover alumnos de derecha a izquierda -->
function moveItemL( a, b ){
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

<!-- Funcion para seleccionar y enviar a los equiposal servidor -->
function selectAllOptions() {
	<?php 
  $i=0;
  while($i < $Cantidad){?>  
var aSelect = document.moveList["<?php echo "namesLeft$i" ?>[]"];
var aSelectLen = aSelect.length;
for(i = 0; i < aSelectLen; i++) {
aSelect.options[i].selected = true;
}
 <?php $i= $i + 1;}?>
 
aSelect = document.moveList["<?php echo "namesRight" ?>[]"];
aSelectLen = aSelect.length;
for(i = 0; i < aSelectLen; i++) {
aSelect.options[i].selected = true;
}
 if(ValidarForma()){
document.getElementById('FormaEquipos').submit();
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
	
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); 
			 $numeroEquipos= mysqli_query($conexion, "select count(*) from equipo WHERE Clave = '".$Clave."' AND Grupo='".$Grupo."'")or die(mysqli_error());
	$countEquipos = mysqli_fetch_array($numeroEquipos); 
echo "<br>";
if(($Cantidad + $countEquipos[0]) < 7){
			?>
			<div id="container" class="CSS_Table_Example" style="width:750px;height:200px;" align="center">
<form id="FormaEquipos" action="servidorEquipo.php" method="post" name="moveList">

<table width="450" border="0">
<tr>
      <td colspan="2" scope="col">Numero de Equipos: </td> <td colspan="2" scope="col"> <?php print("<input type='hidden' size='20' name='Cantidad' id='Cantidad' value=".$Cantidad.">" .$Cantidad. "</input>"); ?></td>
    </tr>
     <tr>
  <td>Clave:</td><td> <?php
		
		print("<input type='hidden' size='20' name='Clave' id='Clave' value=".$Clave.">" .$Clave. "</input>");
	?></td><td>Grupo: </td><td><?php print("<input type='hidden' size='20' name='Grupo' id='Grupo' value=".$Grupo.">" .$Grupo. "</input>");
	?></td>
  </tr>
    <tr>
    <td>Nombre: </td> <td>Miembros:</td> <td>Asignar: </td> <td>Sin Asignar: </td>
    </tr>
    
    
  <?php 
  $i=0;
  while($i < $Cantidad){?>  
  <tr>
  <td><input type="text" size="30" class="req" name="<?php echo "Nombre$i" ?>" id="Nombre"></td>
    <td align="center">
    <select name="<?php echo "namesLeft$i" ?>[]" width="100" style="width: 100px" size="6" multiple="multiple" id="<?php echo "namesLeft$i" ?>">
    
  
    
    </select></td>
    
  <td width="100" align="center" ><input name="" class="buttonsDesign" onClick="moveItem('<?php echo "namesLeft$i" ?>','<?php echo "namesRight" ?>');" type="button" value=">>" />
    <input name="" onClick="moveItemL('<?php echo "namesRight" ?>', '<?php echo "namesLeft$i" ?>');" class="buttonsDesign" type="button" value="<<" /></td>
    <?php 
	if($i==0){print("<td align='center' rowspan=$Cantidad>");}
	
	?>
    
    <?php if ($i ==0){?>
    <select id ="namesRight" name="namesRight[]" size="<?php echo $Cantidad * 6;?>" multiple="multiple" width="100" style="width: 250px" id="<?php echo "namesRight" ?>"> 
     
     <?php
		while($row=mysqli_fetch_array($resultado)){
			$MatriculaAl=$row["Matricula"];
		$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		print("<option value=".$row["Matricula"].">".$row2["Nombre"]. " ".$row2["ApellidoPaterno"]. " " .$row2["ApellidoMaterno"]."</option>");
		}
		$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' and Grupo='$Grupo'");
	?>
    
    </select>
    <?php }
	
	if($i==0){print("</td>");}
	?>
    
  </tr>
  
 <?php $i= $i + 1;}
 ?>
 
 
  
 <tr><td></td><td></td><td></td><td align="right"><input type="button" class="buttonsDesign" value="Crear" onClick="selectAllOptions()" /></td></tr>
</table>


</form>

</div> 
	 <?php 
}
else{
			   echo "<div class='CSS_Table_Example_Center' style='width:600px;height:150px;' align='center'>
<table class='CSS_Table_Example' align='center' width='69%' border=''>  <tr><td colspan='92' scope='col'> ";
  
			  $EquiposPosibles=6-$countEquipos[0];
			  
			  if($EquiposPosibles==0){
				  echo "Solo estan permitidos 6 equipos.";
				  }
			  else{
			  echo "Solo puede hacer ";
			  echo $EquiposPosibles;
			  echo " mas.";
			  }
			  
			  echo "</td></tr></table></div>";
			  }
	  
	} 
	while($row = mysqli_fetch_array($result3)) {
			include("MenuMaestro.html");
			 $numeroEquipos= mysqli_query($conexion, "select count(*) from equipo WHERE Clave = '".$Clave."' AND Grupo='".$Grupo."'")or die(mysqli_error());
	$countEquipos = mysqli_fetch_array($numeroEquipos); 
echo "<br>";
if(($Cantidad + $countEquipos[0]) < 7){
			?>
			<div id="container" class="CSS_Table_Example" style="width:750px;height:200px;" align="center">
<form id="FormaEquipos" action="servidorEquipo.php" method="post" name="moveList">

<table width="450" border="0">
<tr>
      <td colspan="2" scope="col">Numero de Equipos: </td> <td colspan="2" scope="col"> <?php print("<input type='hidden' size='20' name='Cantidad' id='Cantidad' value=".$Cantidad.">" .$Cantidad. "</input>"); ?></td>
    </tr>
     <tr>
  <td>Clave:</td><td> <?php
		
		print("<input type='hidden' size='20' name='Clave' id='Clave' value=".$Clave.">" .$Clave. "</input>");
	?></td><td>Grupo: </td><td><?php print("<input type='hidden' size='20' name='Grupo' id='Grupo' value=".$Grupo.">" .$Grupo. "</input>");
	?></td>
  </tr>
    <tr>
    <td>Nombre: </td> <td>Miembros:</td> <td>Asignar: </td> <td>Sin Asignar: </td>
    </tr>
    
    
  <?php 
  $i=0;
  while($i < $Cantidad){?>  
  <tr>
  <td><input type="text" size="30" class="req" name="<?php echo "Nombre$i" ?>" id="Nombre"></td>
    <td align="center">
    <select name="<?php echo "namesLeft$i" ?>[]" width="100" style="width: 100px" size="6" multiple="multiple" id="<?php echo "namesLeft$i" ?>">
    
  
    
    </select></td>
    
  <td width="100" align="center" ><input name="" class="buttonsDesign" onClick="moveItem('<?php echo "namesLeft$i" ?>','<?php echo "namesRight" ?>');" type="button" value=">>" />
    <input name="" onClick="moveItemL('<?php echo "namesRight" ?>', '<?php echo "namesLeft$i" ?>');" class="buttonsDesign" type="button" value="<<" /></td>
    <?php 
	if($i==0){print("<td align='center' rowspan=$Cantidad>");}
	
	?>
    
    <?php if ($i ==0){?>
    <select id ="namesRight" name="namesRight[]" size="<?php echo $Cantidad * 6;?>" multiple="multiple" width="100" style="width: 250px" id="<?php echo "namesRight" ?>"> 
     
     <?php
		while($row=mysqli_fetch_array($resultado)){
			$MatriculaAl=$row["Matricula"];
		$NombreAlumno=mysqli_query($conexion,"select * from alumno WHERE Matricula='$MatriculaAl'") or die(mysqli_error());
		$row2=mysqli_fetch_array($NombreAlumno);
		print("<option value=".$row["Matricula"].">".$row2["Nombre"]. " ".$row2["ApellidoPaterno"]. " " .$row2["ApellidoMaterno"]."</option>");
		}
		$resultado=mysqli_query($conexion,"select * from clasegrupoalumno where Clave='$Clave' and Grupo='$Grupo'");
	?>
    
    </select>
    <?php }
	
	if($i==0){print("</td>");}
	?>
    
  </tr>
  
 <?php $i= $i + 1;}
 ?>
 
 
  
 <tr><td></td><td></td><td></td><td align="right"><input type="button" class="buttonsDesign" value="Crear" onClick="selectAllOptions()" /></td></tr>
</table>


</form>

</div> 
	 <?php 
}
else{
			   echo "<div class='CSS_Table_Example_Center' style='width:600px;height:150px;' align='center'>
<table class='CSS_Table_Example' align='center' width='69%' border=''>  <tr><td colspan='92' scope='col'> ";
  
			  $EquiposPosibles=6-$countEquipos[0];
			  
			  if($EquiposPosibles==0){
				  echo "Solo estan permitidos 6 equipos.";
				  }
			  else{
			  echo "Solo puede hacer ";
			  echo $EquiposPosibles;
			  echo " mas.";
			  }
			  
			  echo "</td></tr></table></div>";
			  }
	} 
	while($row = mysqli_fetch_array($result4)) {
			include("MenuAlumno.html"); 
	  
	} 
		


		
	
?>
  
            
   


    </body>
</html>
