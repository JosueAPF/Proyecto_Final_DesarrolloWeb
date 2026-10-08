<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    if ($_SESSION['authenticado'] === true) {
        $session_name = $_SESSION['username'];
        $get_rol = $_SESSION['rol'];


        echo "<pre>";
        echo session_id();
        echo "<br>";
        echo $session_name;
        echo $get_rol;
        echo "</pre>";

    }


    ?>

</body>

</html>