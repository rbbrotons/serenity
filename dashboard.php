<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir si no está logueado
    exit();
}

// Evitar cacheo para que no se pueda usar "atrás" después de cerrar sesión
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Panel de Usuario</title>
    <script src="https://kit.fontawesome.com/8534bf3f5a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="./csscarpeta/panel_dash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    
    <div class="sidebar">
        <div class="brand">
            <img class="" src="./images/face-laugh-svgrepo-com.svg" alt="">
            <span>BIENVENIDO/A!</span>       
        </div>
        
        <div class="menu-container">
            <div class="menu-item">
                <a href="./panel.php" class="menu-link">
                    <i class="fa-solid fa-tag" ></i>
                    <span>Productos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./panel_clientes.php" class="menu-link">
                    <i class="fa-solid fa-users" ></i>
                    <span>Clientes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./panel_pedidos.php" class="menu-link">
                    <i class="fa-solid fa-cart-shopping" ></i>
                    <span>Pedidos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./descuentos.php" class="menu-link">
                    <i class="fa-solid fa-tags";"></i>
                    <span>Descuentos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./reportes.php" class="menu-link">
                    <i class="fa-solid fa-file-lines" ></i>
                    <span>Reportes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="" class="menu-link">
                   <i class="fa-solid fa-chart-line" ></i>
                    <span>Dashboard</span>
                </a>
            </div>
        </div>
        <div class="container-usuario">
            <div class="img-usr">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="data-user">
                <span class="nombre">Hola <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
            </div>
            <div class="container-cerrar">
                <button type="button" class="cerrar" id="btnCerrarSesion">Cerrar Sesión<i class="fa-solid fa-right-from-bracket"></i>
            </button>
            </div>
        </div>
    </div>
    <h2 class ="h2-rep">DASHBOARD</h2>
    
     <button id="btnExportarPDF" class="exportar">Exportar <i class="fa-solid fa-file-arrow-down"></i></i></button>

<?php
include_once "./procesar_datos/procesar_dashboard/procesar_rep.php";
?>
    

<script src="./js/js_reportes/exportar_reportes.js"></script>
</body>
<script>
  document.getElementById("btnCerrarSesion").addEventListener("click", function () {
    Swal.fire({
      title: "¿Estás segura/o?",
      text: "Cerrarás tu sesión actual.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#7c71b2",
      cancelButtonColor: "#aaa",
      confirmButtonText: "Sí, cerrar sesión",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "./procesar_datos/procesar_cierre.php"; // archivo PHP que destruye la sesión
      }
    });
  });
</script>

</html>
