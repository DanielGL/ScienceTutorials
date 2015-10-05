<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Arvhivo encargado de iniciar sesion -->
<html>
<head>
<link rel="stylesheet" type="text/css" href="Estilos.css">
<link rel="stylesheet" href="table.css" type="text/css"/>
<script language="Javascript" type="text/javascript" src="validar.js">
</script>
<script>
function valida(){
	
	 if(ValidarForma()){
document.getElementById('Login').submit();
}

else{
	alert("Contrasena o Usuario Incorrecto !");
	}
	}
	
</script>
<title>Pagina inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
</head>

<body>

<h2>Juego Marat&oacute;n</h2>
<div name="tablaInicio" class="CSS_Table_Example_Center" style="width:600px;height:150px;" align="center">
<table class="CSS_Table_Example" align="center" width="69%" border="">
 <form action="manejador_usuarios.php" method="GET" id="Login">
    <tr>
      <td colspan="4" scope="col">Ingrese sus datos: </td>
    </tr>
    <tr><td>ID</td>
      <td><input class="req" type="text" name="id"/></td>

    </tr>
     <tr><td>Contrase&ntilde;a</td>
      <td><input type="password" name="password" class="req"/></td>

    </tr>
    
    <tr>
    <td></td><td align="right"><input type="button" class="buttonsDesign" value="Login" onClick="valida()" /></td>
    </tr>
  </form>
   

 
</table>
</div>
</body>
</html>
