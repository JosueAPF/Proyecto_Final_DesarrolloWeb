<?php
require_once __DIR__ . '/../../../../../services/ClienteServicio.php';
$servicio = new ClienteServicio();
$c_Terceros = $servicio->listarCuentasTerceros($_SESSION['id_usuario']);
?>

<!-- Contenedor para que la tabla no rompa el diseño en móvil -->
<h1 class="panel-title">Listado cuenta de Terceros</h1>
<div class="table-responsive">
    <table class="tabla">
        <thead>
            <tr>
                <th>id</th>
                <th>Alias</th>
                <th>No. Cuenta</th>
                <th>Monto Maximo</th>
                <th>Max Transacciones</th>
                <th>Transferir</th>
            </tr>
        </thead>
        <tbody>
            <!-- bucle lista cajeros --->
            <?php foreach ($c_Terceros as $usuario): ?>
            <tr>
                <form method="POST">
                <td>
                    <input type="hidden"
                            name="id_c_terceros"
                            value="<?= $usuario['id_cuenta_tercero'] ?>">
                    <?= $usuario['id_cuenta_tercero'] ?>
                </td>
                <td>
                    <?= $usuario['alias'] ?>
                </td>
                <td>
                    <?= $usuario['numero_cuenta'] ?>
                </td>
                <td>
                    <?= $usuario['monto_maximo'] ?>
                </td>
                <td>
                    <?= $usuario['max_trans_diarias'] ?>
                </td>
                <td>
                    <input type="submit" value="Transferir" class='btn-danger' name="trasferir"
                            style="text-align: center" ;>
                </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<?php

$id_cuentaTerceros = $_POST['id_c_terceros'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        if (isset($_POST['monto_trasferencia']) && !empty($_POST['monto_trasferencia'])) {

            $monto = (float) $_POST['monto_trasferencia'];

            $transferir = $servicio->transferir(
                $_SESSION['id_usuario'],
                $id_cuentaTerceros,
                $monto
            );

            echo "<p class='msg-success'>";
            echo $transferir['mensaje'];
            echo "</p>";
        }

    } catch (Exception $e) {

        echo "<p class='msg-error'>";
        echo $e->getMessage();
        echo "</p>";
    }
}
?>

<br>
<hr>
<h1 class="panel-title">Transferencias</h1>
<p class="panel-text"> Seleccione una Cuenta en el <strong>listado</strong> boton <strong style="color:red" ;>
        transferir</strong></p>

<form class="panel-form" method="POST">
    <div class="form-group">
        <label for="nombre cuenta">id cliente</label>
        <?php
        echo "<input type='text' name='id_cliente' value='$_SESSION[id_usuario]' readonly require>"
            ?>
    </div>

    <div class="form-group">
        <label for="dpi">id cuenta Terceros</label>
        <input type="text" name="id_c_terceros" value="<?= $id_cuentaTerceros ?? '' ?>" readonly require>
            
    </div>

    <div class="form-group">
        <label for="monto">Monto a Transferir</label>
        <input type="number"  name="monto_trasferencia" step="0.01" min="1" placeholder="0.00" require>
    </div>

    <button class="btn-primary" type="submit">
        Hacer la Transferencia
    </button>
    

</form>