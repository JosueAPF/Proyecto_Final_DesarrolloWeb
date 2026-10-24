<?php require_once __DIR__ . '/../../../../../services/AdminServicio.php';
$servicio = new AdminServicio();
?>

<h1 class="panel-title">Monitor Resumen</h1>
<?php
$monitor_resumen = $servicio->monitor_resumen();
$resumen = $monitor_resumen[0];
?>

<div class="cards-dashboard">

    <div class="card-dashboard">
        <h3>Cuentas Hoy</h3>
        <p><?= $resumen['cuentas_hoy']; ?></p>
    </div>

    <div class="card-dashboard">
        <h3>Clientes Hoy</h3>
        <p><?= $resumen['clientes_hoy']; ?></p>
    </div>

    <div class="card-dashboard">
        <h3>Transacciones</h3>
        <p><?= $resumen['total_transacciones']; ?></p>
    </div>

    <div class="card-dashboard">
        <h3>Depósitos</h3>
        <p><?= $resumen['total_depositos']; ?></p>
    </div>

    <div class="card-dashboard">
        <h3>Retiros</h3>
        <p><?= $resumen['total_retiros']; ?></p>
    </div>

</div>


<h1 class="panel-title">Monitor Montos</h1>
<?php
$monitor_montos = $servicio->monitor_montos();
?>
<div class="cards-dashboard">
 <div class="card-dashboard">
    <h3>Total Depositado</h3>
    <p><?=number_format($monitor_montos['total_depositado'],2);?></p>
</div>

<div class="card-dashboard">
    <h3>Total Retirado</h3>
    <p><?=number_format($monitor_montos['total_retirado'],2);?></p>
</div>
</div>


<hr>
<canvas id="graficaMontos">
    <div id="graficaMontos"></div>
</canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const depositos = <?= $monitor_montos['total_depositado']; ?>;
    const retiros = <?= $monitor_montos['total_retirado']; ?>;
    new Chart(
        document.getElementById('graficaMontos'),
        {
            type: 'doughnut',
            data: {
                labels: [
                    'Depósitos',
                    'Retiros'
                ],
                datasets: [{
                    label: 'Monto en Quetzales',
                    data: [
                        depositos,
                        retiros
                    ],
                    backgroundColor: [
                        '#198754',
                        '#dc3545'
                    ]
                }]
            }
        }
    );

</script>