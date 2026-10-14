<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaza tu hoja de estilos genérica aquí -->
    <link rel="stylesheet" href="../../master.css">
    <title>Banco Nexus - Panel de Control</title>
</head>

<body>

    <!-- ==========================================
         HEADER / NAVBAR
    =========================================== -->
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">

                <!-- Logo -->
                <a href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/" class="nav-logo">
                    BANCO <strong>NEXUS</strong>
                </a>

                <!-- Motor del menú móvil (sin JS) -->
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                
                <!-- Botón Hamburguesa -->
                <label for="menu-toggle" class="nav-toggle" aria-label="Abrir menú de navegación">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>

                <!-- Enlaces de Navegación -->
                <ul class="nav-menu">
                    <li><a href="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/" class="nav-link active">Inicio</a></li>
                    <li><a href="#" class="nav-link">Sucursales</a></li>
                    <li><a href="#" class="nav-link">Preguntas Frecuentes</a></li>
                    <li><a href="#" class="nav-link">Contacto</a></li>
                </ul>

            </div>
        </nav>
    </header>

    <!-- ==========================================
         CONTENIDO PRINCIPAL (Aquí va tu PHP)
    =========================================== -->
    <main class="main-content">
        
        <!-- Lógica PHP (No tocar) -->
        <?php
        require_once __DIR__ . '/../../../../../services/CajeroServicio.php';
        $servicio = new CajeroServicio();
        $misCajeros = $servicio->listarCajero();
        ?>

        <!-- Contenedor para que la tabla no rompa el diseño en móvil -->
        <div class="table-responsive">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>id Usuario</th>
                        <th>Nombre Completo</th>
                        <th>Usuario</th>
                        <th>Bloqueado</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Bucle PHP (No tocar) -->
                    <?php foreach ($misCajeros as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id_usuario'] ?></td>
                        <td><?= $usuario['nombre_completo'] ?></td>
                        <td><?= $usuario['usuario'] ?></td>
                        <td><?= $usuario['bloqueado'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

    <!-- ==========================================
         FOOTER GENÉRICO
    =========================================== -->
    <footer class="main-footer">
        <div class="footer-container">
            <!-- Columna 1: Logo y descripción -->
            <div class="footer-column brand-column">
                <div class="footer-logo-wrapper">
                    <img src="/php_proyectos/Proyecto_Final_DesarrolloWeb/public/img/banco_nexus_banner_f_azul.png" alt="Banco Nexus" class="footer-logo">
                </div>
                <p class="footer-description">
                    Tu aliado financiero. Seguridad, confianza y tecnología en un solo lugar.
                </p>
            </div>

            <!-- Columna 2: Contacto -->
            <div class="footer-column contact-column">
                <h4>Contacto</h4>
                <ul class="footer-contact">
                    <li>📍 Av. Reforma 10-50, Zona 10, Guatemala</li>
                    <li>📞 +502 1234 5678</li>
                    <li>✉️ soporte@banconexus.com</li>
                </ul>
            </div>

            <!-- Columna 3: Datos del Estudiante -->
            <div class="footer-column student-column">
                <div class="student-card">
                    <h4>Proyecto Académico</h4>
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