<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./csscarpeta/inicio.css">
    <title>Pagina de inicio de sesión</title>
</head>
<body>
    <?php
    /*
    include_once("./clases/Cconexion.php");
    $consulta = Cconexion:: ConexionBD();*/
    ?>
    <div class="container">
        
        <h2 class="h2-pres">Iniciar Sesión</h2>
        <form action="./procesar_datos/procesar_login.php" method="POST">
            <div class="formulario-inicio">
                <h4>Nombre de usuario</h4>
                <input type="text" name="nombre_user" placeholder="Nombre de usuario"required>
            </div>
            <div class="formulario-inicio">
                <H4>Contraseña</H4>
                <input type="password" name="contrasena_user" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-ingresar">Iniciar Sesion</button>
        </form> 
        <p class="nt">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>

    </div>
</body>
<?php if (isset($_GET['login']) && $_GET['login'] === 'error'): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: "error",
            title: "El nombre de usuario o la contraseña son incorrectos",
            text: "El nombre de usuario o la contraseña no son válidos.",
            confirmButtonText: "Intentar de nuevo"
        }).then(() => {
            // Elimina el parámetro "login" de la URL sin recargar
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('login');
                window.history.replaceState({}, document.title, url.toString());
            }
        });
    </script>
<?php endif; ?>

</html>