<?php

$session_name = $_SESSION['username'];
$get_rol = $_SESSION['rol'];



/* a ver que trae la session
echo "<pre>";
echo session_id();
echo "<br>";
echo $session_name;
echo "<br>";
echo $get_rol;
echo "<br>";

echo "</pre>";
echo "<br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<br>";
*/

$session_name = $_SESSION['username'];
$get_rol = $_SESSION['rol'];

echo "Hola " . "<strong>" . $session_name . "</strong>";
echo "<hr>";

echo"<div class='.panel-text'>";
echo "<br>";
echo "<h4>Acciones para el Rol</h4>";
echo "<ul>";
echo "<li>Crear Cajero <strong>(Nuevo Cajero)</strong></li>";
echo "<li>Ver Cajeros <strong>(Mis Cajeros)</strong> en conjunto con " ."<strong>Blquear/Desbloquear</strong> cajero</li>";
echo "<li>Salir <strong>(Destruye la session)</strong></li>";
echo "</ul>";
echo "</div>"


/*
echo "<pre>";
echo session_id();
echo "<br>";
echo $session_name;
echo "<br>";
echo $get_rol;
echo "</pre>";
echo "<br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/


?>