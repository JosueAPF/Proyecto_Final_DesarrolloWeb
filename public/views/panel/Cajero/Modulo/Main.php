<h1>Inicio</h1>
<?php


    /**
     * obtencion de los datos de session
     */
    $session_name = $_SESSION['username'];
    $get_rol = $_SESSION['rol'];


    //redireccion usuario cajero bloqueado



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

    echo "Hola";




?>