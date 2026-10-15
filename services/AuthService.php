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
        //!$datos || !isset($datos['estado']) or $datos['estado'] != 'ok'
        if (!$datos || !isset($datos['estado'])) {
            //throw new Exception("Usuario inexistente");
            /*session_start();
            $_SESSION['authenticado'] = false;
            header("Location: /php_proyectos/Proyecto_Final_DesarrolloWeb/public/");
            exit;*/
            throw new Exception('Respuesta inválida');


        }

        switch ($datos['estado']) {
            case 'ok':
                //comparacion de la contraseña plana con la contraseña hasheada
                if (password_verify($pass, $datos['password'])) {
                    return [
                        'id_usuario' => $datos['id_usuario'],
                        'rol' => $datos['rol'],
                        'bloqueado' => $datos['bloqueado']
                        
                    ];
                }
                //si vienen nulos
                throw new Exception('Contraseña incorrecta');

            //esto viene del SP
            case 'Contraseña incorrecta.':
                throw new Exception('Contraseña incorrecta');
                break;
            case 'Cajero esta Bloqueado':
                throw new Exception('Cajero  Bloqueado');
                break;
            default:
                echo "Estado de usuario no válido o no encontrado.";
                break;

        }
    }



}


?>