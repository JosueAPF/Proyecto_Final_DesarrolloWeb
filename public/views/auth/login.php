<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login - Banco Nexus</title>
</head>

<body>

    <!-- ==========================================
         HEADER / NAVBAR GENÉRICO
    =========================================== -->
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">
                <a href="#" class="nav-logo">
                    BANCO <strong>NEXUS</strong>
                </a>

                <!-- Men Hamburguesa-->
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                <label for="menu-toggle" class="nav-toggle" aria-label="Abrir menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>

                <ul class="nav-menu">
                    <li><a href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/" class="nav-link">Principal</a></li>
                    
                </ul>
            </div>
        </nav>
    </header>

    <!-- ==========================================
         CONTENIDO  LOGIN
    =========================================== -->
    <main class="main-content login-page-main">
        
        <!-- ENVOLTORIO PARA CENTRAR LA TARJETA -->
        <div class="login-card-wrapper">
            <div class="browser-window">
                
                <!-- Barra superior simulada -->
                <div class="browser-header">
                    <div class="dots">
                        <span></span><span></span><span></span>
                    </div>
                </div>

                <!-- Banner / Logo -->
                <div class="card-banner">
                    <img src="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/img/banco_nexus_banner_2.png" alt="Banco Nexus" class="login-banner-img">
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
                            $get_user = $usuarioLogueado['id_usuario'];
                            $estaBloqueado = $usuarioLogueado['bloqueado'];

                            //relacionado a session
                            session_regenerate_id(true);

                        } catch (Exception $e) {
                            $mensajeError = $e->getMessage();
                        }
                    }
                }

                /*** Session y Redireccion ***/
                if (isset($mirol)) {
                    switch ($mirol) {
                        case 'ADMIN':
                            $_SESSION['authenticado'] = true;
                            $_SESSION['username'] = $username;
                            $_SESSION['rol'] = $mirol;
                            //Panel Admin
                            header("Location: ../panel/Administrador/Admin.php");
                            exit;
                            break;
                        case 'CAJERO':
                            $_SESSION['authenticado'] = true;
                            $_SESSION['username'] = $username;
                            $_SESSION['rol'] = $mirol;
                            $_SESSION['bloqueado'] = $estaBloqueado;
                            //Panel Cajero
                            header("Location: ../panel/Cajero/Cajero.php");
                            exit;
                            break;
                        case 'CLIENTE':
                            $_SESSION['authenticado'] = true;
                            $_SESSION['username'] = $username;
                            $_SESSION['rol'] = $mirol;
                            //A PANEL CLIENTE
                            //print_r($mirol);
                            header("Location: ../panel/Cliente/Cliente.php");
                            exit;
                        default:
                            # code...
                            break;
                    }
                }
                ?>
         
                <div class="login-content">
                    <h1 class="login-title">
                        <?php
                        if (isset($mirol)) {
                            switch ($mirol) {
                                case 'ADMIN':
                                    echo "<p>Bienvenido Administrador</p>";
                                    break;
                                case 'CAJERO':
                                    echo "<p>Bienvenido Cajero</p>";
                                    break;
                                case 'CLIENTE':
                                    echo "<p>Bienvenido Cliente</p>";
                                    break;
                                default:
                                    echo "<p>Rol Inexistente</p>";
                                    break;
                            }
                        } else {
                            echo "Iniciar Sesión";
                        }
                        ?>
                    </h1>

                    <form method="post" class="login-form">
                        <div class="input-group">
                            <input type="email" name="username" placeholder="Ingrese su correo" autocomplete="off" required>
                        </div>
                        
                        <div class="input-group">
                            <input type="password" name="pass" placeholder="Contraseña" autocomplete="new-password" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">Ingresar</button>

                        <?php if (!empty($mensajeError)): ?>
                            <div class="error-message">
                                <?php echo $mensajeError; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($usuarioLogueado): ?>
                            <p class="success-message">
                                Bienvenido! Rol: <strong><?php echo $usuarioLogueado['rol']; ?></strong>
                            </p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- ==========================================
         FOOTER GENÉRICO
    =========================================== -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-column brand-column">
                <div class="footer-logo-wrapper">
                    <img src="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/img/banco_nexus_banner_f_azul.png" alt="Banco Nexus" class="footer-logo">
                </div>
                <p class="footer-description">
                    Tu aliado financiero. Seguridad, confianza y tecnología en un solo lugar.
                </p>
            </div>

            <div class="footer-column contact-column">
                <h4>Contacto</h4>
                <ul class="footer-contact">
                    <li>📍 Av. Reforma 10-50, Zona 10, Guatemala</li>
                    <li>📞 +502 1234 5678</li>
                    <li>✉️ soporte@banconexus.com</li>
                </ul>
            </div>

            <div class="footer-column student-column">
                <div class="student-card">
                    <h4>Proyecto</h4>
                    <p class="student-name"><strong>Estudiante:</strong> Josue Abraham Porras Figueroa</p>
                    <p class="student-carnet"><strong>Carnet:</strong> 0900-15-18671</p>
                    <p class="student-course">Desarrollo Web - Proyecto Final</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Banco Nexus. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>