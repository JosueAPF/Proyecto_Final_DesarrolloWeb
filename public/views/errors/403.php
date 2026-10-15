<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Autorizado - Banco Nexus</title>
    <!-- Fuente moderna y enlace a tu CSS -->
    <link rel="stylesheet" href="error.css">
</head>

<body>

    <main class="error-wrapper">
        
        <div class="error-card">
            
            <!-- ==========================================
                  LOGO
            =========================================== -->
            <div class="card-banner">
                <div class="logo-placeholder" title="Logo">
                    <img src="../../img/banco_nexus_banner_f_azul.png" width="500px" height="90px" alt="Logo"> 
                </div>
                <br>
                
            </div>

            <!-- ==========================================
                 IMAGEN DEL ERROR 
            =========================================== -->
            <div class="error-image-placeholder">
                <img src="../../img/Acceso_denegado.png" alt="Acceso Denegado"> 
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