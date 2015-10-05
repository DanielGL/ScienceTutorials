<?php

if (isset($_SESSION['cookie1']))
    $id = $_SESSION['cookie1'];
else
    $id = "";
// Se abre la conexion a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "basemaraton");

if (mysqli_connect_errno($conexion)) {
    echo "No se puedo conectar a la base de datos: " . mysqli_connect_error();
}

// Se reciben las variables clave, siguiente  y el orden de las repuestas
$clave = $_GET['c'];
$parcial = $_GET['parcial'];
$siguiente = $_GET['s'];
$orden[0] = $_GET['o1'];
$orden[1] = $_GET['o2'];
$orden[2] = $_GET['o3'];
$orden[3] = $_GET['o4'];

$i = 0; // Contador para el numero de preguntas

if($parcial==5){
$resultado = mysqli_query($conexion, "select * from pregunta where Clase='$clave'");
}
else{
    $resultado = mysqli_query($conexion, "select * from pregunta where Clase='$clave' and Parcial='$parcial'");
}

// Se busca la pregunta
while ($i < $siguiente) {
    $row = mysqli_fetch_array($resultado);
    $i++;
}
$prueba="tity";
echo "<input type='button' value='Pregunta' name='pregunta' class='pregunta' onclick='obtienepregunta()'/>";
echo "<input type='button' value='Salir del juego' name='cancelar' class='cancelar' onclick='cancelarjuego()'/>";
echo "<input type='button' value='Mostrar/Ocultar puntajes' name='puntajesB' class='puntajesB' onclick='display_puntajes()'/>";
echo "<p id='timer' class='timer'></p>";

echo "<table align='center'>";
echo "<tr>";

if($row['Imagen']==1)
echo "<td>" .$row['Descripcion'] . "<input type='button' value='Imagen' name='imagen' onclick='ver_imagen()'/></td>";
else
    echo "<td>" .$row['Descripcion'] ."</td>";

echo "<td>";
echo "<form>";

// Se pone el orden de las repuestas
for ($x = 0; $x <= 3; $x++) {

    if ($orden[$x] == 1) {
        echo "<input type='radio' name='respuesta' value='correcta'>" . $row['Respuesta1'] . "<br>";
    } else if ($orden[$x] == 2) {
        echo "<input type='radio' name='respuesta' value='incorrecta'>" . $row['Respuesta2'] . "<br>";
    } else if ($orden[$x] == 3) {
        echo "<input type='radio' name='respuesta' value='incorrecta'>" . $row['Respuesta3'] . "<br>";
    } else if ($orden[$x] == 4) {
        echo "<input type='radio' name='respuesta' value='incorrecta'>" . $row['Respuesta4'] . "<br>";
    }
}
echo "</td>";
echo "<td>";

$dificultad = $row['Dificultad'];

// Se pone diferente argumento dependiendo de la dificultad de la pregunta
if ($dificultad == 1) {

    echo "<input type='button' value='Responder' name='responder' onclick='checa(2)'/>";
    $frase = "Conceptos básicos";
} else if ($dificultad == 2) {

    echo "<input type='button' value='Responder' name='responder' onclick='checa(4)'/>";
    $frase = "Seguimiento de código básico";
} else {

    echo "<input type='button' value='Responder' name='responder' onclick='checa(6)'/>";
    $frase = "Completar codificación";
}

echo "</form>";
echo "</td>";
echo "<td><img id='resultado' width='107' height='98'></td>";
echo "<td> Tipo de pregunta: " . $frase . "</td>";
echo "</td>";
echo "</tr>";
echo "</table>";

// Se cierra la conexion a la base de datos
mysqli_close($conexion);
?>