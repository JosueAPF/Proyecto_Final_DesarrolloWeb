<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../master.css">
    <title>Panel Administrativo</title>
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
                <!-----------hamburguesa---------------------------------->
                <!-- Checkbox  -->
                <input type="checkbox" id="menu-toggle" class="menu-toggle">

                <!-- Label  -->
                <label for="menu-toggle" class="nav-toggle" aria-label="Abrir menú de navegación">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
                <!-----------hamburguesa---------------------------------->

                <ul class="nav-menu">
                    <li><?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo "<strong style='color:#1E3A8A;'>[" . $_SESSION['rol'] . "]</strong> ";
                        echo "<strong>" .$_SESSION['username'] . "</strong>";
                    }
                    ?>
                    </li>
                    <li>
                        <a href="Admin.php?GestionCajero=Main" class="nav-link active">Inicio</a>
                    </li>
                    <li>
                        <a href="Admin.php?GestionCajero=NuevoCajero" class="nav-link">Nuevo Cajero</a>
                    </li>
                    <li>
                        <a href="Admin.php?GestionCajero=listarCajeros" class="nav-link">Mis Cajeros</a>
                    </li>
                    <li><a href='../logaout.php' class="nav-link">Salir</a></li>
                </ul>

            </div>
        </nav>
    </header>
    <main class="main-content">
        <?php
       
        if (
            $_SESSION['authenticado'] === true and
            isset($_SESSION['rol']) and
            $_SESSION['rol'] === "ADMIN" and
            isset($_SESSION['username'])
        ) {
           
            //fragmentos
            echo "<div class='panel-body'>";
            $seccion = $_GET['GestionCajero'] ?? 'inicio';

            //debug chafa-> se supone que me tare solo el nombre de la "seccion"
            //echo "Modulo recibido: " . $seccion . "<br>";
        
            switch ($seccion) {

                case 'listarCajeros':
                    require 'GestionCajero/listarCajeros.php';
                    break;
                case 'NuevoCajero':
                    require 'GestionCajero/NuevoCajero.php';
                    break;
                default:
                    require 'GestionCajero/Main.php';

            }
            echo'</div>';
        } else {
            header("Location: /php_proyectos/Proyecto_Final_DesarrolloWeb/public/views/errors/403.php");
            exit;
        }
        ?>
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
                    <h4>Datos</h4>
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