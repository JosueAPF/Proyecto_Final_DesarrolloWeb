<?php
require_once __DIR__ . '/../config/DbContext.php';
class AuthRepository
{
    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new DbContext();
    }

    /**
     * consume una sp 
     * parametros nesesarios $username (es un correo electronico)
     * 
     */
    public function Login(string $username)
    {
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_login(?)");
        $conn->bind_param("s", $username);
        $conn->execute();
        //$dbconn->close();
        return $conn->get_result()->fetch_assoc();
    }
}

/*
$repo = new AuthRepository();
$datos = $repo->Login("cajero1@banco.com");
print_r($datos['estado']);
echo "<br>";
print_r($datos['id_usuario']);
echo "<br>";
print_r("Rol : ".$datos['rol']);
echo "<br>";
print_r($datos['password']);
echo "<br>";
print_r($datos['bloqueado']);
*/

?>