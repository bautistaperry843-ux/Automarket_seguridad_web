<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo_pagina = "Inicio - AutoMarket";
require_once __DIR__ . '/includes/header.php';

$mensaje_bienvenida = "";
if (isset($_SESSION['alerta_bienvenida'])) {
    $mensaje_bienvenida = $_SESSION['alerta_bienvenida'];
    unset($_SESSION['alerta_bienvenida']);
} else {
    $nombre_visitante = $_SESSION['usuario_nombre'] ?? '';
    $saludo = $nombre_visitante !== '' ? "¡Hola, $nombre_visitante! " : "¡Hola! ";
    $mensaje_bienvenida = $saludo . "¡Bienvenido a AutoMarket!";
}
?>

<?php if (!empty($mensaje_bienvenida)): ?>
    <div class="alerta-bienvenida">
        <?= htmlspecialchars($mensaje_bienvenida); ?>
    </div>
<?php endif; ?>

<main>
    <section class="hero-section">
        <img src="foto de auto.jfif" alt="Logotipo oficial de AutoMarket">
        <h2><?= htmlspecialchars($app_name); ?></h2>
        <p>Encuentra el vehículo ideal con la confianza de una concesionaria con experiencia en Salta.</p>
    </section>

    <section class="info-section">
        <h2>Bienvenido(a) a la web oficial de <?= htmlspecialchars($app_name); ?></h2>
        <p>Explorá nuestro catálogo, revisá autos en oferta y contactanos para más información.</p>

        <div class="grid-container">
            <div class="card">
                <h3>Últimas Ventas Realizadas</h3>
                <p>Revisá los vehículos entregados recientemente en nuestra sucursal.</p>
            </div>
            <div class="card">
                <h3>Autos Agregados Recientemente</h3>
                <p>Ingresos semanales de unidades seleccionadas e inspeccionadas.</p>
            </div>
        </div>

        <div class="support-box">
            <h3>Atención y Soporte</h3>
            <p>¿Tienes dudas? Escríbenos directamente a <?= htmlspecialchars($support_email); ?>.</p>
            <p>
                <a href="contacto.php" class="btn">Enviar mensaje al Soporte</a>
            </p>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>