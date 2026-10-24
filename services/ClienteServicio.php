<?php

require_once __DIR__ . '/../repository/UsuarioRepository.php';

class ClienteServicio
{
    private UsuarioRepository $repo;

    public function __construct()
    {
        $this->repo = new UsuarioRepository();
    }
    public function Registrar_nuevo_usuario(string $numeroCuenta, string $correo, string $dpi, string $claveHash, string $confirmPass)
    {
        try {
            // Validar confirmación
            if ($claveHash !== $confirmPass) {
                return [
                    'estado' => 1,
                    'mensaje' => 'Las contraseñas no coinciden'
                ];
            }

            $pass = password_hash($claveHash, PASSWORD_DEFAULT);


            $nuevoUsuario = $this->repo->registrar_NuevoUsuario($numeroCuenta, $correo, $dpi, $pass);
            if ($nuevoUsuario['estado'] != 0) {
                throw new Exception($nuevoUsuario['mensaje']);
            }
            return $nuevoUsuario;
        } catch (Exception $e) {

            return [
                'estado' => -1,
                'mensaje' => $e->getMessage()
            ];
        }
    }

    /**
     * Agregar cuenta de tercero
     */
    public function agregarCuentaTercero(int $idCliente, string $numeroCuenta, float $montoMaximo, int $maxTransDiarias, string $alias)
    {
        try {
            /**                                   a usuario 7
             * CALL sp_agregar_cuenta_tercero(10,'CTA57594062',1000,2,'cliente prueba 2');
             * 
             * verificar siempre id_usuario y id_cuenta
             */
            $resultado = $this->repo->agregar_cuenta_terceros(
                $idCliente,
                $numeroCuenta,
                $montoMaximo,
                $maxTransDiarias,
                $alias
            );

            if ($resultado['estado'] != 0) {
                throw new Exception($resultado['mensaje']);
            }

            return $resultado;

        } catch (Exception $e) {

            return [
                'estado' => 0,
                'mensaje' => 'OK'
            ];
        }
    }

    /**
     * Listar cuentas de tercero
     */
    public function listarCuentasTerceros(int $idCliente)
    {
        try {

            return $this->repo->listar_cuenta_terceros($idCliente);

        } catch (Exception $e) {

            return [
                'estado' => -1,
                'mensaje' => $e->getMessage()
            ];
        }
    }

    /**
     * Transferencia
     */
    public function transferir(int $idCliente, int $idCuentaTercero, float $monto)
    {
        try {

            $resultado = $this->repo->transferencia(
                $idCliente,
                $idCuentaTercero,
                $monto
            );

            if ($resultado['estado'] != 0) {
                throw new Exception($resultado['mensaje']);
            }

            return $resultado;

        } catch (Exception $e) {

            return [
                'estado' => -1,
                'mensaje' => $e->getMessage()
            ];
        }
    }

    /**
     * Estado de cuenta
     */
    public function estadoCuenta(int $idCliente)
    {
        try {

            return $this->repo->estado_cuenta($idCliente);

        } catch (Exception $e) {

            return [
                'estado' => -1,
                'mensaje' => $e->getMessage()
            ];
        }
    }

    public function obtenerSaldo(int $id_usuario){
        try {
            return $this->repo->obtener_saldo_cliente($id_usuario);
        } catch (Exception $e) {
            return [
                'estado' => -1,
                'mensaje' => $e->getMessage()
            ];
        }
    }
}

/*
$servicio = new ClienteServicio();
$obtenerSaldo = $servicio->obtenerSaldo(16);
print_r($obtenerSaldo);
*/
?>