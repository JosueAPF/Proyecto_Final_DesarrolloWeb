<?php
require_once __DIR__ . '/../repository/CajeroRepository.php';
class CajeroServicio
{

    private $repo;

    public function __construct()
    {
        $this->repo = new CajeroRepository();
    }


    public function crearCajero(string $nombreCompleto, string $usuario, string $clave_hash)
    {
        try {
            $pass = password_hash($clave_hash, PASSWORD_DEFAULT);
            $nuevo_cajero = $this->repo->crear_cajero($nombreCompleto, $usuario, $pass);
            /*
            if($nuevo_cajero['estado'] != 'ok'){
                   throw new Exception("Algo salio mal XD");
            }*/
            switch ($nuevo_cajero['estado']) {
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

    public function listarCajero()
    {

        try {
            $misCajeros = $this->repo->listar_cajero();
            return $misCajeros;

        } catch (Exception $e) {
            return $e->getMessage();
            
        }
    }



    /**
     * Generador de Numero para cuentas
     * @return string
     */
    private function generar_noCuenta(): string
    {
        do {
            $numeroCuenta = 'CTA' . rand(10000000, 99999999);
            $existe = $this->repo->existeNo_cuenta($numeroCuenta);
        } while ($existe);

        return $numeroCuenta;
    }

    public function crearCuenta(string $nombre_cuenta, string $dpi, float $monto_inicial)
    {
        try {
            $no_cuenta = $this->generar_noCuenta();

            if (isset($nombre_cuenta) and isset($dpi) and isset($monto_inicial)) {
                
                //existencia del dpi
                if ($this->repo->existeDpi($dpi)) {
                    throw new Exception(
                        "Ya existe una cuenta con el DPI: $dpi"
                    );
                }

                $nueva_cuenta = $this->repo->crear_cuenta($no_cuenta, $nombre_cuenta, $dpi, $monto_inicial);
                switch ($nueva_cuenta['estado']) {
                    /*el monto inicial debe ser mayor a cero */
                    case "el monto inicial debe ser mayor a cero":
                        throw new Exception("Error Monto inicial debe ser mayor a cero");
                    case "Esta cuenta ya Existe en la DB":
                        throw new Exception("la Cuenta ya existe");
                    case "Cuenta creada correctamente":
                        return $nueva_cuenta;
                    default:
                        throw new Exception("Respuesta inesperada del procedimiento almacenado");
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}
/*
$servicio = new CajeroServicio();
$cajero = $servicio->listarCajero();*/
/*
echo "<pre>";
print_r($cajero);
echo "</pre>";
echo "<br>";
echo "<p>Estatus:</p>";
echo "<br>";*/

/*

foreach($cajero as $user){
echo "<pre>";
print_r($user);
echo "</pre>";
}*/
?>