<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <main class="login-main-contenedor">

        <!------esto para que era XD-------------------->
        <div class="browser-window">


            <!-- Barra superior del navegador -->
            <div class="browser-header">
                <div class="dots">
                    <span></span><span></span><span></span>
                </div>
                <div class="url-bar">nombrebanco.com/login-admin</div>
            </div>

            <!-----------banner---------------------->
            <div class="card-banner">
                <div class="logo-placeholder" title="Espacio para el Logo">
                    <!-- AQUÍ PONES TU IMAGEN: <img src="tu-logo.png" alt="Logo"> -->
                    LOGO
                </div>
                <h2>Nombre del Banco</h2>
            </div>

            <?php
            //iniciamos la session
            session_start();
            //---------------------
            require_once __DIR__ . '/../../../services/AuthService.php';
            $mensajeError = '';
            $usuarioLogueado = null;



            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['username']) and isset($_POST['pass'])) {
                    $username = $_POST['username'];
                    $password = $_POST['pass'];
                    try {
                        $service = new AuthService();
                        $usuario = $service->Login($username, $password);
                        $usuarioLogueado = $usuario;
                        $mirol = $usuarioLogueado['rol'];

                        //relacionado a session
                        session_regenerate_id(true);
                        //---->esto es mejor evaluarlo en el switch
                        /*
                        $_SESSION['authenticado'] = true;
                        $_SESSION['username'] = $usuario['username'];
                        header("Location: /php_desarrollo_web/Session_prueba_SID_2/public/views/lista.php");
                        exit;*/


                    } catch (Exception $e) {
                        $mensajeError = $e->getMessage();
                    }
                }
            }


            
            /***
             * 
             * /Session y Redireccion
             * 
             */
            if (isset($mirol)) {
                switch ($mirol) {
                    case 'ADMIN':
                        $_SESSION['authenticado'] = true;
                        $_SESSION['username'] = $usuario[$username];
                        $_SESSION['rol'] = $mirol;
                        //usar uno de prueba
                        header("Location: ../panel/Admin.php");
                        exit;
                        break;
                    case 'CAJERO':
                        $_SESSION['authenticado'] = true;
                        $_SESSION['username'] = $usuario[$username];
                        $_SESSION['rol'] = $mirol;
                        //usar uno de prueba
                        header("Location: ../panel/Cajero.php");
                        exit;
                        break;
                    default:
                        # code...
                        break;
                }

            }

            ?>

            <div class="login-content">
                <h1 class="login-title">
                    <?php

                    /**
                     * 
                     * Mensaje para la cabezera del formulario
                     * 
                     */
                    if (isset($mirol)) {
                        switch ($mirol) {
                            case 'ADMIN':
                                echo "<p>Bienvenido Usuario administrador</p>";
                                break;
                            case 'CAJERO':
                                echo "<p>Bienvenido Usuario cajero</p>";
                                break;
                            case 'CLIENTE':
                                echo "<p>Bienvenido Usuario Cliente</p>";
                                break;
                            default:
                                echo "<p>Rol Inexistente</p>";
                                break;
                        }


                    }
                    ?>

                </h1>
                <form method="post">
                    <input type="email" name="username" placeholder="ingrese un email valido" autocomplete="off"
                        required>
                    <br>
                    <input type="password" name="pass" placeholder="password" autocomplete="new-password" required>
                    <br>
                    <input type="submit" value="Enviar">


                    <!----------------
            aqui estoy obteniendo los roles usar session aqui y direccionamientos
            que tal un if sobre rol obtneido
            $usuarioLogueado['rol']
        -------------------->
                    <?php if (!empty($mensajeError)): ?>
                        <p style="color: red;"><?php echo $mensajeError; ?></p>
                    <?php endif; ?>

                    <?php if ($usuarioLogueado): ?>
                        <p style="color: green;">
                            Bienvenido! Rol: <strong><?php echo $usuarioLogueado['rol']; ?></strong>
                        </p>
                    <?php endif; ?>


                </form>
            </div>
        </div>
    </main>
</body>

</html>