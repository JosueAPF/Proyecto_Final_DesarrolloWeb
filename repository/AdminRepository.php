<?php
require_once __DIR__ . '/../config/DbContext.php';
class AdminReposirory
{
    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new DbContext();
    }
    /**
     * consumo del sp_monitor_resumen
     * @return array|bool|null
     */
    public function monitor_resumen(){
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_monitor_resumen()");
        $conn->execute();
        return $conn->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * consumo del sp_monitor_montos
     * @return array|bool|null
     */
    public function monitor_montos(){
        //sp_monitor_montos
        $dbconn = $this->dbConn->getConnection();
        $conn = $dbconn->prepare("CALL sp_monitor_montos()");
        $conn->execute();
        return $conn->get_result()->fetch_assoc();
    }

    
}
/*
$repo = new AdminReposirory();
$monitor_resumen = $repo->monitor_resumen();
$monitor_montos = $repo->monitor_montos();


echo "<h1>Monitor Resumen</h1>";
echo "<br>";
echo "cuentas_hoy  ";
print_r($monitor_resumen["cuentas_hoy"]);
echo "<br>";
echo "clientes_hoy  ";
print_r($monitor_resumen["clientes_hoy"]);
echo "<br>";
echo "total_transacciones  ";
print_r($monitor_resumen["total_transacciones"]);
echo "<br>";
echo "total_depositos  ";
print_r($monitor_resumen["total_depositos"]);
echo "<br>";
echo "total_retiros  ";
print_r($monitor_resumen["total_retiros"]);
//total_retiros

echo "<br>";
echo "<h1>Monitor Montos</h1>";
echo "<pre>";
echo "Total Depositado  :";
print_r($monitor_montos["total_depositado"]);
echo "</pre>";
echo "<hr>";
echo "<pre>";
echo "Total Retirado  :";
print_r($monitor_montos["total_retirado"]);
echo "</pre>";


*/

?>