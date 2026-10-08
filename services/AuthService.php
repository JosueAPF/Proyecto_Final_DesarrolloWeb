<?php
require_once __DIR__ . '/../repository/AuthRepository.php';
class AuthService
{
    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository();
       
    }

    public function Login(string $userName, string $pass)
    {
        $datos = $this->repo->Login($userName);
        if (!$datos || !isset($datos['estado']) or $datos['estado'] != 'ok') {
            throw new Exception("Usuario inexistente");
        }

        switch ($datos['estado']) {
            case 'ok':
                //comparacion de la contraseña plana con la contraseña hasheada
                if (password_verify($pass, $datos['password'])) {
                    return [
                        'id_usuario' => $datos['id_usuario'],
                        'rol' => $datos['rol']
                    ];
                }
                break;
            
            //esto viene del SP
            case 'Contraseña incorrecta.':
                throw new Exception('Cajero bloqueado');
                break;
            case 'Cajero esta Bloqueado':
                throw new Exception('Usuario inexistente');
                break;
            default:
                echo "Estado de usuario no válido o no encontrado.";
                break;

        }
    }



}


?>