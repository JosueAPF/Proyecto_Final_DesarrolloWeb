<?php
require_once __DIR__ . '/../repository/CajeroRepository.php';
class CajeroServicio{

    private $repo;

    public function __construct(){
        $this->repo = new CajeroRepository();
    }


    public function crearCajero(string $nombreCompleto,string $usuario,string $clave_hash){
        try {
             $pass = password_hash($clave_hash, PASSWORD_DEFAULT);
             $nuevo_cajero = $this->repo->crear_cajero($nombreCompleto,$usuario,$pass);
             /*
             if($nuevo_cajero['estado'] != 'ok'){
                    throw new Exception("Algo salio mal XD");
             }*/
             switch($nuevo_cajero['estado']){
                case "ERROR":
                    throw new Exception("la transaccion se interrumpio");
                    break;
                case "Usuario Existente":
                    throw new Exception("el usuario ya existe");
                    break;
             }
             return $nuevo_cajero;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
/*
$servicio = new CajeroServicio();
$cajero = $servicio->crearCajero("danilo figuero","danilo@mail.com","danilo123");
echo"<pre>";
print_r($cajero);
echo"</pre>";
echo"<br>";
echo $cajero['estado'];*/
?>