<?php
include_once(__DIR__ . '/../../clases/Creportes.php');

// Datos de los reportes
$cantProductosCategoria = Creportes::CantProductosPorCategoria();
$clientesMasCompras = Creportes::ClientesConMasCompras();
$productosMasPedidos = Creportes::ProductosMasPedidos();
$productosSinPedidos = Creportes::ProductosSinPedidos();

// Preparar arrays para Chart.js
$categorias = [];
$cantPorCategoria = [];
foreach($cantProductosCategoria as $fila){
    $categorias[] = $fila['nombre_cat'];
    $cantPorCategoria[] = (int)$fila['cantidad_productos'];
}

$clientes = [];
$cantCompras = [];
foreach($clientesMasCompras as $fila){
    $clientes[] = $fila['Nombre_apellido'];
    $cantCompras[] = (int)$fila['cantidad_compras'];
}

$prodPedidos = [];
$cantPedidos = [];
foreach($productosMasPedidos as $fila){
    $prodPedidos[] = $fila['nombre'];
    $cantPedidos[] = (int)$fila['total_pedidos'];
}

$prodSin = [];
$preciosSin = [];
foreach($productosSinPedidos as $fila){
    $prodSin[] = $fila['nombre'];
    $preciosSin[] = (float)$fila['precio']; // eje Y será el precio
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Reportes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 45%;
            margin: 40px auto;
        }
    </style>
</head>
<body>

<div class="charts-grid">
    <div class="chart-container">
        <h3>Cantidad de productos por categoría</h3>
        <canvas id="chartCategoria"></canvas>
    </div>

    <div class="chart-container">
        <h3>Clientes con más compras</h3>
        <canvas id="chartClientes"></canvas>
    </div>

    <div class="chart-container">
        <h3>Productos más pedidos</h3>
        <canvas id="chartMasPedidos"></canvas>
    </div>

    <div class="chart-container">
        <h3>Productos sin pedidos</h3>
        <canvas id="chartSinPedidos"></canvas>
    </div>
</div>

<script>
// Productos por categoría (torta)
new Chart(document.getElementById('chartCategoria'), {
    type: 'pie',
    data: {
        labels: <?= json_encode($categorias) ?>,
        datasets: [{
            data: <?= json_encode($cantPorCategoria) ?>,
            backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#9b59b6', '#1abc9c']
        }]
    }
});

// Clientes con más compras (barra horizontal)
new Chart(document.getElementById('chartClientes'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($clientes) ?>,
        datasets: [{
            label: 'Cantidad de compras',
            data: <?= json_encode($cantCompras) ?>,
            backgroundColor: '#e67e22'
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        scales: { x: { beginAtZero: true } }
    }
});

// Productos más pedidos (barra vertical)
new Chart(document.getElementById('chartMasPedidos'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($prodPedidos) ?>,
        datasets: [{
            label: 'Cantidad de pedidos',
            data: <?= json_encode($cantPedidos) ?>,
            backgroundColor: '#3498db'
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});

// Productos sin pedidos (barra vertical, eje Y = precio)
new Chart(document.getElementById('chartSinPedidos'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($prodSin) ?>,
        datasets: [{
            label: 'Precio ($)',
            data: <?= json_encode($preciosSin) ?>,
            backgroundColor: '#e74c3c'
        }]
    },
    options: {
        responsive: true,
        scales: { 
            y: { 
                beginAtZero: true,
                title: { display: true, text: 'Precio ($)' }
            }
        }
    }
});
</script>

</body>
</html>
