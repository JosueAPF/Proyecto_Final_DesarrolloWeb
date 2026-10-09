<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Autorizado - Banco Nexus</title>
    <!-- Fuente moderna y enlace a tu CSS -->
    <link rel="stylesheet" href="403.css">
</head>

<body>

    <main class="error-wrapper">
        
        <div class="error-card">
            
            <!-- ==========================================
                 BANNER / LOGO (Preparado para tu imagen)
            =========================================== -->
            <div class="card-banner">
                <div class="logo-placeholder" title="Espacio para el Logo">
                    <!-- AQUÍ PONES TU IMAGEN: <img src="tu-logo.png" alt="Logo"> -->
                    LOGO
                </div>
                <h2>Nombre del Banco</h2>
            </div>

            <!-- ==========================================
                 IMAGEN DEL ERROR 403 (Preparado para tu imagen)
            =========================================== -->
            <div class="error-image-placeholder">
                <!-- AQUÍ PONES TU IMAGEN: <img src="error-403.png" alt="Acceso Denegado"> -->
                <span>Espacio para imagen 403</span>
            </div>

            <!-- ==========================================
                 CONTENIDO DEL ERROR
            =========================================== -->
            <div class="error-content">
                
                <h1>Acceso Denegado</h1>
                <p>No tiene permisos para acceder a esta sección.</p>

                <!-- Enlaces de acción (Tu código PHP original intacto) -->
                <div class="action-links">
                    <h1>Inciar sesion</h1>
                    <?php echo "<a href='../auth/login.php'>ir a incio de session</a>"?>
                    <br>
                    <h1>Ir a Inicio</h1>
                    <?php echo "<a href='/php_proyectos/Proyecto_Final_DesarrolloWeb/public/'>ir a incio de session</a>"?>
                    </a>
                </div>

            </div>

        </div>

    </main>

</body>
</html>