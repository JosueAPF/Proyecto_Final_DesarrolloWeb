


<?php
require_once __DIR__ . '/../../../../../services/CajeroServicio.php';
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    if (
        isset($_POST['numero_cuenta']) &&
        isset($_POST['montoD'])
    ) {
        try {

            $no_cuenta = $_POST['numero_cuenta'];
            $monto_deposito = $_POST['montoD'];


            $servicio = new CajeroServicio();
            $Retiro = $servicio->generar_retiro($no_cuenta, $monto_deposito);
            echo "<br>";
            echo "<p class='msg-success'>";
            print_r($Retiro["mensaje"]);
            echo "</p>";
        } catch (Exception $e) {
            echo "<p class='msg-error'>";
            echo $e->getMessage();
            echo "</p>";
        }

    }
}

?>
<h1 class="panel-title">Retiro Monetario</h1>

<form class="panel-form" method="POST">


    <div class="form-group">
        <label for="numero cuenta">Numero Cuenta</label>
        <input type="text" id="numero_cuenta" name="numero_cuenta">
    </div>

    <div class="form-group">
        <label for="monto">Monto Incial</label>
        <input type="number" id="monto" name="montoD" step="0.01" min="1" placeholder="0.00">
    </div>

    <button class="btn-primary" type="submit">
        Acreditar
    </button>

</form>