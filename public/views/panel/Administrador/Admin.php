<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['authenticado'] === true and  
        isset($_SESSION['rol']) and 
        $_SESSION['rol'] === "ADMIN") {


        $session_name = $_SESSION['username'];
        $get_rol = $_SESSION['rol'];


        echo "<pre>";
        echo session_id();
        echo "<br>";
        echo $session_name;
        echo $get_rol;
        echo "</pre>";

        echo "<br>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";


        echo "<br>";
        echo "<a href='../logaout.php'>Salir</a>";
    } else {
        //$link = require '../views/errors/403.php';
        //echo $link;
        //header("Location: ../views/errors/403.php");
        //exit;
        header("Location: /php_proyectos/Proyecto_Final_DesarrolloWeb/public/views/errors/403.php");
        exit;
    }


    ?>
</body>

</html>