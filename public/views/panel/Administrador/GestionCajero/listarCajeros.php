<?php
require_once __DIR__ . '/../../../../../services/CajeroServicio.php';
$servicio = new CajeroServicio();
$misCajeros = $servicio->listarCajero();

?>

<!-- Contenedor para que la tabla no rompa el diseño en móvil -->
<div class="table-responsive">
    <table class="tabla">
        <thead>
            <tr>
                <th>id Usuario</th>
                <th>Nombre Completo</th>
                <th>Usuario</th>
                <th>Bloqueado</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <!-- bucle lista cajeros --->
            <?php foreach ($misCajeros as $usuario): ?>
            <tr>
                <td>
                    <?= $usuario['id_usuario'] ?>
                </td>
                <td>
                    <?= $usuario['nombre_completo'] ?>
                </td>
                <td>
                    <?= $usuario['usuario'] ?>
                </td>
                <?php
                if ($usuario['bloqueado'] === 1) {
                    $id_row_bloq = $usuario['id_usuario'];
                    echo "<td>Bloqueado</td>";
                    echo "<td>";
                    echo "<form action='/php_proyectos/Proyecto_Final_DesarrolloWeb/public/views/panel/Administrador/GestionCajero/procesar.php' method='POST'>";
                    echo "<input type='hidden' name='id_usuario' value='$id_row_bloq'>";
                    echo "<input type='submit' name='accion' class='btn-danger' value='Desbloquear'>";
                    echo "</form>";
                    echo "</td>";

                } elseif ($usuario['bloqueado'] === 0) {
                    $id_row_desbloq = $usuario['id_usuario'];
                    echo "<td>Operativo</td>";
                    echo "<td>";
                    echo "<form action='/php_proyectos/Proyecto_Final_DesarrolloWeb/public/views/panel/Administrador/GestionCajero/procesar.php' method='POST'>";
                    echo "<input type='hidden' name='id_usuario' value='$id_row_desbloq'>";
                    echo "<input type='submit' name='accion' class='btn-primary' value='Bloquear'>";
                    echo "</form>";
                    echo "</td>";

                }
                ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>