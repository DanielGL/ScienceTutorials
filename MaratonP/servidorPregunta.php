<!DOCTYPE html>
<?php 
/*Este archivo guarda en la base de datos los dato de la nueva pregunta recibida como argumento
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
<link rel="stylesheet" href="table.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="Estilos.css">


        
    </head>
    <body>
      <?php
$result=mysqli_query($conexion,"select * from superadmin t WHERE t.ID = '".  $id ."'") or die(mysqli_error()); 
	$result2=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=1") or die(mysqli_error());
	$result3=mysqli_query($conexion,"select * from maestro t WHERE t.Nomina = '".  $id ."' AND t.Administrador=0") or die(mysqli_error());
	$result4=mysqli_query($conexion,"select * from alumno t WHERE t.Matricula = '".  $id ."'") or die(mysqli_error());
	$Clave=$_POST["Clave"];  //clave de la materia a la que pertenece la pregunta

	
		
$Descripcion=$_POST["Descripcion"]; //descripcion de la pregunta
$Tema=$_POST["Tema"]; //tema de la pregunta
$Parcial=$_POST["Parcial"];  //parcial de la pregunta
$Dificultad=$_POST["Difficultad"];  //dificultad de la pregunta
$Respuesta1=$_POST["Respuesta1"]; //respuesta CORRECTA de la pregunta
$Respuesta2=$_POST["Respuesta2"]; //primer respuesta incorrecta de la pregunta
$Respuesta3=$_POST["Respuesta3"]; //segunda respuesta incorrecta de la pregunta
$Respuesta4=$_POST["Respuesta4"]; //tercera respuesta incorrecta de la pregunta
$Imagen=$_POST["Imagen"]; //variable para verificar si la pregunta contiene imagen

if($Imagen==1){
	mysqli_query($conexion, "INSERT INTO pregunta (Descripcion,Tema,Parcial,Dificultad,Respuesta1,Respuesta2,Respuesta3,Respuesta4,Imagen,Clase,ImagenSubida) VALUES 
('$Descripcion','$Tema','$Parcial','$Dificultad','$Respuesta1','$Respuesta2','$Respuesta3','$Respuesta4',$Imagen,'$Clave',0)")or die(mysqli_error()); 

$resultadoID=mysqli_query($conexion,"select ID from pregunta WHERE ImagenSubida = 0") or die(mysqli_error()); 
$rowID=mysqli_fetch_array($resultadoID);
     $info = pathinfo($_FILES['file']['name']);
  $ext = "png";
  $newname = $Clave."-".$rowID["ID"].".".$ext;

    $newFilePath = "./MaratonA/upload/" . $newname;

      move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath);
	  
	  mysqli_query($conexion, "update pregunta
set ImagenSubida=1 where ImagenSubida=0")or die(mysqli_error()); 
	  }
	  
	 else{
		 mysqli_query($conexion, "INSERT INTO pregunta (Descripcion,Tema,Parcial,Dificultad,Respuesta1,Respuesta2,Respuesta3,Respuesta4,Imagen,Clase,ImagenSubida) VALUES 
('$Descripcion','$Tema','$Parcial','$Dificultad','$Respuesta1','$Respuesta2','$Respuesta3','$Respuesta4',$Imagen,'$Clave',1)")or die(mysqli_error()); 
		 }
	while($row = mysqli_fetch_array($result)) {
			include("MenuSuperAdmin.html"); 
	   
	} 
	while($row = mysqli_fetch_array($result2)) {
			include("MenuMaestroAdmin.html"); ?>
            
       <div class="CSS_Table_Example" style="width:600px;height:150px;" align="center">
        <form action="CrearPreguntaAlt.php" method="get">
<table class="CSS_Table_Example" align="center" width="69%" border="">

  <tr>
      <td colspan="4" scope="col">Datos de la nueva pregunta: </td>
    </tr> 
     <tr> 
                <td align="right">Materia:</td> 
                <td >
                <?php
		
		print("<input type='hidden' size='20' name='Clave' id='Clave' value=".$Clave.">" .$Clave. "</input>");
	?></td> 
            </tr>
            <tr> 
                <td align="right">Descripcion:</td> 
                <td><?php echo $Descripcion ?></td> 
            </tr> 
            <tr> 
                <td align="right">Tema:</td> 
                <td><?php echo $Tema ?></td> 
            </tr> 
            <tr> 
                <td align="right">Parcial:</td> 
                <td><?php echo $Parcial ?></td> 
            </tr> 
            <tr> 
                <td align="right">Dificultad:</td> 
                <td><?php echo $Dificultad ?></td> 
            </tr> 
            <tr> 
                <td align="right">Respuesta1:</td> 
                <td><?php echo $Respuesta1 ?></td> 
            </tr>
            <tr> 
                <td align="right">Respuesta2:</td> 
                <td><?php echo $Respuesta2 ?></td> 
            </tr>
            <tr> 
                <td align="right">Respuesta3:</td> 
                <td><?php echo $Respuesta3 ?></td> 
            </tr>  
            <tr> 
                <td align="right">Respuesta4:</td> 
                <td><?php echo $Respuesta4 ?></td> 
            </tr>  
 			<tr> 
                <td align="right">Imagen:</td> 
                <td><?php if($Imagen==1){
					
					echo "Si";
					}
					
					else{echo "No";}
				
				
				?> </td> 
            </tr>
           
           
            <tr><td></td><td align="right"><input type="submit" value="Mas" class="buttonsDesign"></td>
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
?>
    </body>
</html>
