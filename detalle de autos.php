<?php
$titulo_pagina = "Ficha Técnica del Vehículo - AutoMarket";
require_once __DIR__ . '/includes/header.php';
?>

<main>
    <section class="hero-section">
        <h2>Deportivo Premium 2023</h2>
        <img src="deprtivo.jfif" alt="Auto Deportivo">
        <div class="price" style="font-size: 1.8rem;">Precio: $10.000 USD</div>
    </section>

    <section class="card">
        <h3>Especificaciones Técnicas:</h3>
        <ul>
            <li><strong>Año:</strong> 2023</li>
            <li><strong>Kilómetros:</strong> 25.000 km</li>
            <li><strong>Transmisión:</strong> Automática</li>
            <li><strong>Combustible:</strong> Nafta</li>
            <li><strong>Papeles:</strong> Al día, listo para transferir</li>
        </ul>
        <br>
        <a href="contacto.php" class="btn">Consultar por este Auto ✉️</a>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>