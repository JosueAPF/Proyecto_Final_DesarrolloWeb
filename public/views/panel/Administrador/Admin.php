<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/views/panel/panel_style.css">
    <title>Panel Administrativo</title>
</head>

<body>
    <header class="main-header">
    <!-- ==========================================
         NAVBAR GENÉRICO - BANCO NEXUS 
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
                <li><a href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/" class="nav-link active">Inicio</a></li>
                <li><a href="#" class="nav-link">Sucursales</a></li>
                <li><a href="#" class="nav-link">Preguntas Frecuentes</a></li>
                <li><a href="#" class="nav-link">Contacto</a></li>
            </ul>

        </div>
    </nav>
</header>
    <main>
        <?php
        session_start();
        if (
            $_SESSION['authenticado'] === true and
            isset($_SESSION['rol']) and
            $_SESSION['rol'] === "ADMIN" and
            isset($_SESSION['username'])
        ) {
            echo "<br>";

            $session_name = $_SESSION['username'];
            $get_rol = $_SESSION['rol'];


            echo "<pre>";
            echo session_id();
            echo "<br>";
            echo $session_name;
            echo "<br>";
            echo $get_rol;
            echo "</pre>";
            echo "<br>";
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";


            echo "<br>";
            echo "<a href='../logaout.php'>Salir</a>";
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
                    <img src="img/banco_nexus_banner_f_azul.png" class="footer-logo">
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