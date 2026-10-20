<?php

require_once __DIR__ . '/../../../../../services/CajeroServicio.php';


if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    if (
        isset($_POST['nombre_cajero']) &&
        isset($_POST['usuario']) &&
        isset($_POST['pass']) &&
        isset($_POST['confir_clave'])
    ) {
        try {

            $nombre_cajero = $_POST['nombre_cajero'];
            $usuario = $_POST['usuario'];
            $Passwor = $_POST['pass'];
            $confirmPass = $_POST['confir_clave'];

            if($Passwor !== $confirmPass) {
                throw new Exception("la confirmacion de contraseña incorrecta", 1);
                
               
            }


            $servicio = new CajeroServicio();
            $crear_cuenta_cajero = $servicio->crearCajero($nombre_cajero, $usuario, $Passwor);
            echo "<p class='msg-success'>";
            if($crear_cuenta_cajero["estado"] === 'ok'){
                echo "Cuenta Creada con Exito <strong>Cajero :</strong>  ".$nombre_cajero;
            }
            echo "</p>";
        } catch (Exception $e) {
            echo "<p class='msg-error'>";
            echo $e->getMessage();
            echo "</p>";
        }

    }
}
/**
 * string $nombreCompleto, string $usuario, string $clave_hash
 */
//$NuevoCajero = $servicio->crearCajero();


?>


<h1 class="panel-title">Crear Cajero</h1>

<form class="panel-form" method="POST">

    <div class="form-group">
        <label for="nombre completo">Nombre Completo</label>
        <input type="text" name="nombre_cajero" placeholder="Pepito Pepe Perez Hernandez" autocomplete="off" required>
    </div>

    <div class="form-group">
        <label for="usuario">Usuario (Correo)</label>
        <input type="text" name="usuario" placeholder="nombreCajero@banco.com" autocomplete="off" required>
    </div>

    <div class="form-group">
        <label for="clave">Ingrese una clave</label>
        <input type="password" name="pass" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label for="clave_confirm">Confirme la Clave</label>
        <input type="password" name="confir_clave" autocomplete="off" required>
    </div>

    <button class="btn-primary" type="submit">
        Crear Cajero
    </button>

</form>