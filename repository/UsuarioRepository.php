<?php
class UsuarioRepository{
    private $dbConn;


    public function __construct()
    {
        $this->dbConn = new DbContext();
    }
    /**
     * consumo del sp_registrar_cliente
     * @param string $numeroCuenta
     * @param string $correo
     * @param string $dpi
     * @param string $claveHash
     * @return array|bool|null
     */
    public function registrar_NuevoUsuario(string $numeroCuenta,string $correo,string $dpi,string $claveHash){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_registrar_cliente(?,?,?,?)");
        $conn->bind_param("ssss", $numeroCuenta,$correo,$dpi,$claveHash);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }
}


?>