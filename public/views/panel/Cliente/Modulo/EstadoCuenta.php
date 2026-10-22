<?php

    require_once __DIR__ . '/../../../../../services/ClienteServicio.php';
    $servicio = new ClienteServicio();

    $estado_cuenta = $servicio->estadoCuenta($_SESSION['id_usuario']);

    
   

?>

<h1 class="panel-title">Estado de Cuenta</h1>

<div class="table-responsive">
    <table class="tabla">
        <thead>
            <tr>
                <th>Fecha y Hora</th>
                <th>Tipo</th>
                <th>Débito</th>
                <th>Crédito</th>
            </tr>
        </thead>

        <tbody>

            <?php
        

            if (!empty($estado_cuenta)):
                foreach ($estado_cuenta as $movimiento):
            ?>

            <tr>
                <td><?= $movimiento['fecha_hora'] ?></td>
                <td><?= $movimiento['tipo'] ?></td>
                <td>Q <?= number_format($movimiento['debito'], 2) ?></td>
                <td>Q <?= number_format($movimiento['credito'], 2) ?></td>
            </tr>

            <?php
                endforeach;
            else:
            ?>

            <tr>
                <td colspan="4" style="text-align:center;">
                    No existen movimientos registrados
                </td>
            </tr>

            <?php endif; ?>

        </tbody>
    </table>
</div>
