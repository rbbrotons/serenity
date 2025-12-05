<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Registro</title>
</head>
<body>
    <?php
    /*
    include_once("./clases/Cconexion.php");
    $consulta = Cconexion:: ConexionBD();*/
    ?>
    <div class="container">
        
        <h2 class="h2-pres">Regístrate</h2>
        <form action="./procesar_datos/procesar_registro.php" method="post">
            <div class="formulario-registro">
                <h4>Correo Electronico</h4>
                <input type="email" name="nuevo_correo_user" placeholder="Correo electronico"required>
            </div>
            <div class="formulario-registro">
                <h4>Nombre de usuario</h4>
                <input type="text" name="nuevo_nombre_user" placeholder="Nombre de usuario"required>
            </div>
            <div class="formulario-registro">
                <H4>Contraseña</H4>
                <input type="password" name="nueva_contrasena_user" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-registro">Registrarse</button>
        </form> 
        <p class="yt">¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>

    </div>
</body>
<?php if (isset($_GET['registro'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($_GET['registro'] === 'exito'): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Cuenta creada!',
            text: 'Tu cuenta fue registrada correctamente.',
            confirmButtonText: 'Ir al inicio'
        }).then(() => {
            window.location.href = 'index.php';
        });
    <?php elseif ($_GET['registro'] === 'existe'): ?>
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'El nombre de usuario o correo electrónico ya están en uso.',
            confirmButtonText: 'Volver'
        });
    <?php elseif ($_GET['registro'] === 'faltan_datos'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Faltan datos en el formulario.',
            confirmButtonText: 'Volver'
        });
    <?php else: ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo registrar el usuario. Inténtalo más tarde.',
            confirmButtonText: 'Volver'
        });
    <?php endif; ?>
</script>
<?php endif; ?>

</html>