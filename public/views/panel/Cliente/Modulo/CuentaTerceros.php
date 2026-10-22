<?php
require_once __DIR__ . '/../../../../../services/ClienteServicio.php';
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    if (
        isset($_POST['id_cliente'])&&
        isset($_POST['no_cuenta']) &&
        isset($_POST['monto_maximo']) &&
        isset($_POST['cantidad_maxima'])&&
        isset($_POST['alias'])
    ) {
        try{
            $id_cliente = $_POST['id_cliente'];
            $nom_cuenta = $_POST['no_cuenta'];
            $monto_max = (float) $_POST['monto_maximo'];
            $cant_max = (int) $_POST['cantidad_maxima'];
            $alias = $_POST['alias'];
    
            $servicio = new ClienteServicio();
            $agregar_c_terceros = $servicio->agregarCuentaTercero($id_cliente,$nom_cuenta, $monto_max, $cant_max, $alias);
            echo "<p class='msg-success'>";
            print_r($agregar_c_terceros["mensaje"]);
            echo "</p>";
        }catch(Exception $e){
            echo "<p class='msg-error'>";
            echo $e->getMessage();
            echo "</p>";
        }
        
    }
}



?>


<h1 class="panel-title">Agregar Cuenta de Terceros</h1>


<form class="panel-form" method="POST">

    <div class="form-group">
        <label for="nombre cuenta">id Cliente</label>
        <?php
        echo "<input type='text' name='id_cliente' value='$_SESSION[id_usuario]' readonly>"
        ?>
    </div>

    <div class="form-group">
        <label for="nombre cuenta">No. Cuenta</label>
        <input type="text" name="no_cuenta" required>
    </div>

    <div class="form-group">
        <label for="dpi">Monto Maximo</label>
        <input type="money"  name="monto_maximo" step="0.01" min="1" placeholder="0.00" required>
    </div>

    <div class="form-group">
        <label for="monto">Cantidad Maxima</label>
        <input type="number"  name="cantidad_maxima" required>
    </div>

    <div class="form-group">
        <label for="monto">Alias</label>
        <input type="text"  name="alias" required>
    </div>

    <button class="btn-primary" type="submit">
        Agregar Cuenta
    </button>

</form>