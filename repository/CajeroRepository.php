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
        return $conn->get_result()->fetch_all(MYSQLI_ASSOC); //para traerlos a todos
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
        $conn->bind_param("ii", $id_usuario, $bloquear);
        $conn->execute();
        return $conn->get_result()->fetch_assoc(); //solo por un mensaje
    }
    /**
     * consumo del sp_crear_cuenta 
     * @param string $numero_cuenta
     * @param string $nombre_cuenta
     * @param string $dpi
     * @param float $monto_inicial
     * @return array
     */
    public function crear_cuenta(string $numero_cuenta, string $nombre_cuenta, string $dpi, float $monto_inicial)
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_crear_cuenta(?,?,?,?)");
        $conn->bind_param("sssd", $numero_cuenta, $nombre_cuenta, $dpi, $monto_inicial);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }
    /**
     * consumo del sp_existe_numero_cuenta
     * @param string $numero_cuenta
     * @return bool
     */
    public function existeNo_cuenta(string $numero_cuenta)
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_existe_numero_cuenta(?)");
        $conn->bind_param("s", $numero_cuenta);
        $conn->execute();
        $resultado = $conn->get_result()->fetch_assoc();
        return (bool) $resultado['existe'];
    }
    /**
     * consulta de ayuda no es sp existeDpi
     * @param string $dpi
     * @return bool
     */
    public function existeDpi(string $dpi): bool
    {
        $dbconn = $this->dbConn->getConnection();
        $stmt = $dbconn->prepare(
            "SELECT 1 FROM cuenta WHERE dpi = ? LIMIT 1"
        );

        $stmt->bind_param("s", $dpi);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }


}

/*prueba */
/*
$servicio = new CajeroRepository();
$no_cuenta = $servicio->existeNo_cuenta("555555");
echo"<pre>";
print_r($no_cuenta);
echo"</pre>";

//echo $no_cuenta;
*/

?>