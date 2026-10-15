<?php
require_once __DIR__ . '/../../../../../services/CajeroServicio.php';
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    if (
        isset($_POST['nombre_cuenta']) &&
        isset($_POST['dpi']) &&
        isset($_POST['monto'])
    ) {
        try{

            $nombre_cuenta = $_POST['nombre_cuenta'];
            $dpi = $_POST['dpi'];
            $monto_inicial = (float) $_POST['monto'];
    
    
            $servicio = new CajeroServicio();
            $crear_cuenta = $servicio->CrearCuenta($nombre_cuenta, $dpi, $monto_inicial);
            echo "<p class='msg-success'>";
            print_r($crear_cuenta["estado"]);
            echo "</p>";
        }catch(Exception $e){
            echo "<p class='msg-error'>";
            echo $e->getMessage();
            echo "</p>";
        }
        
    }
}

?>
<h1 class="panel-title">Crear Cuenta</h1>
<p class="panel-text"> su numero de cuenta se generar automaticamente</p>

<form class="panel-form" method="POST">

    <div class="form-group">
        <label for="nombre cuenta">Nombre Cuenta</label>
        <input type="text" id="nombre_cuenta" name="nombre_cuenta">
    </div>

    <div class="form-group">
        <label for="dpi">dpi</label>
        <input type="text" id="dpi" name="dpi">
    </div>

    <div class="form-group">
        <label for="monto">Monto Incial</label>
        <input type="number" id="monto" name="monto" step="0.01" min="1" placeholder="0.00">
    </div>

    <button class="btn-primary" type="submit">
        Crear Cuenta
    </button>

</form>