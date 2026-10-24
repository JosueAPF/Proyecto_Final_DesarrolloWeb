<?php
require_once __DIR__ . '/../config/DbContext.php';
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

    /**
     * consumo sp_agregar_cuenta_tercero
     * @param int $id_cliente
     * @param string $no_cuenta
     * @param float $monto_maximo
     * @param int $max_tran_diarias
     * @param string $alias
     * @return array|bool|null
     */
    public function agregar_cuenta_terceros(int $id_cliente,string $no_cuenta,float $monto_maximo,int $max_tran_diarias,string $alias){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_agregar_cuenta_tercero(?,?,?,?,?)");
        $conn->bind_param("isdis",$id_cliente,$no_cuenta,$monto_maximo, $max_tran_diarias,$alias);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }
    /**
     * consumo del sp_listar_cuenta_tercero
     * @param int $id_cliente
     * @return array|bool|null
     */
    public  function listar_cuenta_terceros(int $id_cliente){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_listar_cuentas_tercero(?)");
        $conn->bind_param("i",$id_cliente);
        $conn->execute();
       return $conn->get_result()->fetch_all(MYSQLI_ASSOC); //para traerlos a todos
    }
    /**
     * consumo del sp_transferir
     * @param int $id_cliente
     * @param int $id_cuenta_terceros
     * @param float $monto
     * @return array|bool|null
     */
    public function transferencia(int $id_cliente,int $id_cuenta_terceros, float $monto){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_transferir(?,?,?)");
        $conn->bind_param("iid",$id_cliente, $id_cuenta_terceros, $monto);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }
    /**
     * consumo del sp_estado_cuenta
     * @param int $id_cliente
     * @return array|bool|null
     */
    public function estado_cuenta(int $id_cliente){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_estado_cuenta(?)");
        $conn->bind_param("i",$id_cliente);
        $conn->execute();
        return $conn->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    /**
     * 
     * consumo del sp_obtener_saldo
     */

    public function obtener_saldo_cliente(int $id_usuario){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_obtener_saldo(?)");
        $conn->bind_param("i",$id_usuario);
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }

}


?>