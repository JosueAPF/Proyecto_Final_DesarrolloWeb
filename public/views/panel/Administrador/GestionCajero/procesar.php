<?php
    require_once __DIR__ . '/../../../../../services/CajeroServicio.php';
    $servicio = new CajeroServicio();
    
    $idUsuario = $_POST['id_usuario'];
    $accion = $_POST['accion'];
    /*
    echo "ID: " . $idUsuario;
    echo "<br>Acción: " . $accion;*/
    
    if($accion == 'Bloquear' ){
        $bloq = $servicio->accion_bloquear_cajero($idUsuario,1);
        header("Location: ../Admin.php?GestionCajero=listarCajeros");
        exit;
    }else{
        //desbloquear
        $bloq = $servicio->accion_bloquear_cajero($idUsuario,0);
        header("Location: ../Admin.php?GestionCajero=listarCajeros");
        exit;
        
    }

?>