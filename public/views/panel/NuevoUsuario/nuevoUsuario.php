<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../master.css">
    <title>Panel Cajero</title>
</head>

<body>
    <header class="main-header">
        <!-- ==========================================
         NAVBAR GENeRICO 
        ========================================== -->
        <nav class="navbar">
            <div class="nav-container">

                <!-- Logo -->
                <a href="#" class="nav-logo">
                    BANCO <strong>NEXUS</strong>
                </a>

                <!-- 1. Checkbox oculto (El "motor" del menú) -->
                <input type="checkbox" id="menu-toggle" class="menu-toggle">

                <!-- 2. Label que funciona como botón hamburguesa -->
                <label for="menu-toggle" class="nav-toggle" aria-label="Abrir menú de navegación">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>

                <!-- 3. Enlaces de Navegación -->
                <ul class="nav-menu">
                    <li><a href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/" class="nav-link">Principal</a>
                    </li>

                </ul>


            </div>
        </nav>
    </header>

    <main class="main-content">
        <?php
            require_once __DIR__ . '/../../../../services/ClienteServicio.php';
            $servicio = new ClienteServicio();


            if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

                if (
                    isset($_POST['numero_cuenta']) &&
                    isset($_POST['Correo']) &&
                    isset($_POST['dpi']) &&
                    isset($_POST['pass'])&&
                    isset($_POST['passConfirm'])
                ) {
                    try {

                        $no_cuenta = $_POST['numero_cuenta'];
                        $usuario = $_POST['Correo'];
                        $dpi = $_POST['dpi'];
                        $pass = $_POST['pass'];
                        $confirmPass = $_POST['passConfirm'];

                        if($confirmPass != $pass){
                            echo "<p class='msg-error'>";
                            echo"Error de confirmacion de contraseña";
                            echo "</p>";
                        }

                        
                        $nuevo_usuario = $servicio->Registrar_nuevo_usuario($no_cuenta, $usuario, $dpi, $pass,$confirmPass);
                       
                        echo "<p class='msg-success'>";
                        print_r($nuevo_usuario["mensaje"]);
                        echo "</p>";
                    } catch (Exception $e) {
                        echo "<p class='msg-error'>";
                        echo $e->getMessage();
                        echo "</p>";
                    }

                }
            }

            ?>

        <div class="panel-layout">
            
            <form class="panel-form" method="POST">


                <div class="form-group">
                    <label for="numerocuenta">No Cuenta Bancaria</label>
                    <input type="text" name="numero_cuenta" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="Correo" required>
                </div>

                <div class="form-group">
                    <label for="dpi">DPI</label>
                    <input type="text" name="dpi" required>
                </div>

                <div class="form-group">
                    <label for="dpi">Contraseña</label>
                    <input type="password" name="pass" required>
                </div>
                <div class="form-group">
                    <label for="dpi">Confirmar Contraseña</label>
                    <input type="password" name="passConfirm" required>
                </div>

                <button class="btn-primary" type="submit">
                    Registrar
                </button>

            </form>

            <!-- AQUÍ AGREGAS LA IMAGEN -->
            <div class="panel-image">
                <!-- Reemplaza el src con la ruta de tu imagen -->
                <img src="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/img/NuevoUsuario.png"
                    class="login-banner-img" style="mix-blend-mode: multiply;">
            </div>

        </div>
    </main>

    <!----------Footer generico hay que usarlo en todas las vistas------------->
    <footer class="main-footer">
        <div class="footer-container">
            <!-- Columna 1: Logo y descripción -->
            <div class="footer-column brand-column">
                <div class="footer-logo-wrapper">
                    <!-- Reemplaza esto con la ruta de tu logo horizontal o el búho -->
                    <img src="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/img/banco_nexus_banner_f_azul.png"
                        class="footer-logo">
                    <!-- Si no tienes la imagen aún, puedes usar este texto temporalmente -->
                    <!-- <span class="logo-text">BANCO <strong>NEXUS</strong></span> -->
                </div>
                <p class="footer-description">
                    Tu aliado financiero. Seguridad, confianza y tecnología en un solo lugar.
                </p>
            </div>
            <!-- Columna 3: Contacto (Datos Ficticios) -->
            <div class="footer-column contact-column">
                <h4>Contacto</h4>
                <ul class="footer-contact">
                    <li>📍 Av. Reforma 10-50, Zona 10, Guatemala</li>
                    <li>📞 +502 1234 5678</li>
                    <li>✉️ soporte@banconexus.com</li>
                </ul>
            </div>

            <!-- Mis datos no esta de mas -->
            <div class="footer-column student-column">
                <div class="student-card">
                    <h4>Proyecto Académico</h4>
                    <p class="student-name"><strong>Estudiante:</strong> Josue Abraham Porras Figueroa</p>
                    <p class="student-carnet"><strong>Carnet:</strong> 0900-15-18671</p>
                    <p class="student-course">Desarrollo Web - Proyecto Final</p>
                </div>
            </div>

        </div>
        <!-- Barra inferior de Copyright -->
        <div class="footer-bottom">
            <p>&copy; Banco Nexus. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>