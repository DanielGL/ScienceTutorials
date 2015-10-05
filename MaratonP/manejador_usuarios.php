<html>
<head>
<script src="script.js"></script>
<?php 
session_start(); 

$conexion=mysql_connect("localhost","root","");
mysql_select_db("basemaraton",$conexion);


	if(isset($_GET["id"])){
		$id= $_GET["id"];
	    $_SESSION['cookie1'] = $id;
	}else if(isset($_SESSION['cookie1']))
		$id = $_SESSION['cookie1'];
	else
		$id="";
	
	if(isset($_GET["password"])){
		$password = $_GET["password"];
		$_SESSION['cookie2']= $password;		
	}else if(isset($_SESSION['cookie2']))
		$password = $_SESSION['cookie2'];
	else
		$password="";
	
$result=mysql_query("select Matricula, Contrasenia from Alumno a WHERE a.Matricula = '".$id."' AND a.Contrasenia = '".$password."'", $conexion) or die(mysql_error()); 

		if($row = mysql_fetch_array($result) != NULL){
			$_SESSION['username']= $id;
			header( 'Location:Inicio.php' ) ;
		} else {
			$result=mysql_query("select Nomina, Contrasenia from Maestro a WHERE a.Nomina = '".$id."' AND a.Contrasenia = '".$password."' AND a.Administrador = 1 ", $conexion) or die(mysql_error()); 
			$result2=mysql_query("select Nomina, Contrasenia from Maestro a WHERE a.Nomina = '".$id."' AND a.Contrasenia = '".$password."' AND a.Administrador = 0 ", $conexion) or die(mysql_error()); 
			if($row = mysql_fetch_array($result) != NULL){
				$_SESSION['username']= $id;
				header( 'Location:Inicio.php' ) ;
			}  
			
			else if($row = mysql_fetch_array($result2) != NULL){
				$_SESSION['username']= $id;
				header( 'Location:Inicio.php' ) ;
			} 
			
			
			else{
					$result=mysql_query("select ID, Contrasenia from SuperAdmin a WHERE a.ID = '".$id."' AND a.Contrasenia = '".$password."'", $conexion) or die(mysql_error()); 
					if($row = mysql_fetch_array($result) != NULL){
						$_SESSION['username']= $id;
						header( 'Location:Inicio.php' ) ;
					}
					
					else{
						
                      
					  	header( 'Location:index.php' ) ; 
					 
						}
					
					
				}
			}?>
		
</head>
<body>

					<table border="1" align="center">
					<tr>
						<td align="center">
						<p>Login incorrecto</p>
						<input type="button" value="Regresar" onClick="salir()">
						</td>
					</tr>
					</table>
                  

</body> 
</html>
