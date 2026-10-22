<?php
   /**
     * obtencion de los datos de session
     */
    $session_name = $_SESSION['username'];
    $get_rol = $_SESSION['rol'];
    //$get_id = $_SESSION['id_usuario'];



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
    echo "<li>Agregar cuenta de terceros</li>";
    echo "<li>listar cuenta de terceros</li>";
    echo "<li>Transferencias a cuentas de terceros</li>";
    echo "<li>Estado de cuenta</li>";
    echo "</ul>";
    echo "</pre>";

?>