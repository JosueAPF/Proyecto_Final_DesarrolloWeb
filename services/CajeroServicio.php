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
                case "Usuario Existente":
                    throw new Exception("el usuario ya existe");
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
    /**
     * /
     * @param string $nombre_cuenta
     * @param string $dpi
     * @param float $monto_inicial
     * @throws Exception
     * @return 
     */
    public function crearCuenta(string $nombre_cuenta, string $dpi, float $monto_inicial)
    {
        try {
            //se genera el numero de cuenta
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

    /**
     * generar_deposito
     * @param string $no_cuenta
     * @param float $monto
     * @throws Exception
     * @return array
     */
    public function generar_deposito(string $no_cuenta, float $monto)
    {
        try {
            //validadcion
            if (empty($no_cuenta)) {
                throw new Exception("Número de cuenta requerido");
            }
            if ($monto <= 0) {
                throw new Exception("El monto debe ser mayor a 0");
            }
            //
            $miDeposito = $this->repo->hacer_deposito($no_cuenta, $monto);
            switch ($miDeposito["estado"]) {
                case 0:
                    return $miDeposito;
                case 2:
                    throw new Exception("La cuenta no existe");
                case 3:
                    throw new Exception("Error interno al realizar el depósito");
                default:
                    throw new Exception("Respuesta inesperada del procedimiento almacenado");
            }


        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * generar_retiro
     * @param string $no_cuenta
     * @param float $monto
     * @throws Exception
     * @return array
     */
    public function generar_retiro(string $no_cuenta, float $monto)
    {
        try {
            //validadcion
            if (empty($no_cuenta)) {
                throw new Exception("Número de cuenta requerido");
            }
            if ($monto <= 0) {
                throw new Exception("El monto debe ser mayor a 0");
            }
            //
            $miRetiro = $this->repo->hacer_retiro($no_cuenta, $monto);
            switch ($miRetiro["estado"]) {
                case 0:
                    return $miRetiro;
                case 2:
                    throw new Exception("La cuenta no existe");
                case 3:
                    throw new Exception("Error interno al realizar el depósito");
                default:
                    throw new Exception("Respuesta inesperada del procedimiento almacenado");
            }


        } catch (Exception $e) {
            throw $e;
        }
    }

    /*esto es para usuario cliente*/
    /**
     * /
     * @param string $numero_cuenta
     * @param string $correo
     * @param string $dpi
     * @param string $pass
     * @throws Exception
     * @return array
     */
    public function generar_registro_cliente(string $numero_cuenta, string $correo, string $dpi, string $pass)
    {
        try {
            //validadcion
            if (empty($no_cuenta) ||  empty($correo) ||  empty($dpi) ||  empty($pass)) {
                throw new Exception("Faltan campos requeridos requerido");
            }

            $registroCuenta = $this->repo->crear_cuenta($numero_cuenta, $correo, $dpi, $pass);
            if ($registroCuenta["estado"] != 0) {
                throw new Exception($registroCuenta["mensaje"]);
            }
            return $registroCuenta;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
/*
$servicio = new CajeroServicio();
$cajero = $servicio->generar_deposito("CTA38608086",100.00);

echo "<pre>";
print_r($cajero);
echo "</pre>";
echo "<br>";
echo "<p>Estatus:</p>";
echo "<br>";
?>*/