<?php
require_once __DIR__ . '/../config/DbContext.php';
class CajeroRepository{
    private $dbConn;


    public function __construct(){
        $this->dbConn = new DbContext();
    }

    /**
     * consumo del sp_crear_cajero
     * @param string $nombreCompleto
     * @param string $usuario
     * @param string $clave_hash
     * 
     */
    public function crear_cajero(string $nombreCompleto,string $usuario,string $clave_hash){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_crear_cajero(?,?,?)");
        $conn->bind_param("sss",$nombreCompleto,$usuario,$clave_hash);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }


}

?>