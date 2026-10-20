<h1>Inicio</h1>
<?php


    /**
     * obtencion de los datos de session
     */
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

    echo "Hola " . "<strong>" . $session_name . "</strong>";
    echo "<hr>";
    
    echo "<br>";
    echo "<h4>Acciones para el Rol</h4>";
    echo "<pre>";
    echo "<ul>";
    echo "<li>Crear Cuenta</li>";
    echo "<li>Deposito Monetario</li>";
    echo "<li>Retiro Monetario</li>";
    echo "</ul>";
    echo "</pre>";




?>