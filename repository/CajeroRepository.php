<?php
require_once __DIR__ . '/../config/DbContext.php';
class CajeroRepository
{
    private $dbConn;


    public function __construct()
    {
        $this->dbConn = new DbContext();
    }

    /**
     * consumo del sp_crear_cajero
     * @param string $nombreCompleto
     * @param string $usuario
     * @param string $clave_hash
     * @return array asociativo
     * 
     */
    public function crear_cajero(string $nombreCompleto, string $usuario, string $clave_hash)
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_crear_cajero(?,?,?)");
        $conn->bind_param("sss", $nombreCompleto, $usuario, $clave_hash);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }

    /**
     * 
     * consumo del sp_listar_cajero
     * @param 
     * @return array
     * 
     */

    public function listar_cajero()
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_listar_cajeros()");
        $conn->execute();
        return $conn->get_result()->fetch_all(); //para traerlos a todos
    }
    /**
     * consumo del sp_cambiar_bloaqueo_cajero
     * @param int $id_usuario
     * @param int $bloquear  bloquear = 1, desbloquear = 0
     * @return string (retorna mensaje (Cajero bloqueado) o (Cajero desbloqueado))
     */
    public function bloquear_cajero(int $id_usuario, int $bloquear)
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_cambiar_bloqueo_cajero(?,?)");
        $conn->bind_param("ii",$id_usuario,$bloquear);
        $conn->execute();
        return $conn->get_result()->fetch_assoc(); //solo por un mensaje
    }


}

/*prueba */
/*
$servicio = new CajeroRepository();
$cajero_bloq = $servicio->bloquear_cajero(5,1);
echo"<pre>";
print_r($cajero_bloq);
echo"</pre>";
echo"<br>";
echo"<p>Estatus:</p>";
echo"<br>";
echo $cajero_bloq['mensaje'];*/


?>