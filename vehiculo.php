<?php
require_once __DIR__ . '/config/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM vehiculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    $titulo_pagina = "Vehículo no encontrado";
    require_once __DIR__ . '/includes/header.php';
    echo "<main style='padding: 20px;'><h2>Vehículo no encontrado</h2><p>El vehículo que buscas no existe o fue eliminado.</p><a href='catalogo.php'>Volver al Catálogo</a></main>";
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$auto = $res->fetch_assoc();
$titulo_pagina = htmlspecialchars($auto['titulo']) . " - AutoMarket";
require_once __DIR__ . '/includes/header.php';
?>

<main style="padding: 20px; max-width: 800px; margin: 0 auto;">
    <section class="hero-section" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
        <h2><?= htmlspecialchars($auto['titulo']) ?></h2>
        <div style="width: 100%; max-height: 400px; overflow: hidden; border-radius: 8px; margin: 15px 0;">
            <img src="uploads/<?= htmlspecialchars($auto['imagen']) ?>" alt="<?= htmlspecialchars($auto['titulo']) ?>" style="width: 100%; object-fit: cover;">
        </div>
        <div class="price" style="font-size: 1.8rem; font-weight: bold; color: #28a745; margin-bottom: 15px;">Precio: $<?= number_format($auto['precio'], 2) ?> USD</div>
    </section>

    <section class="card" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-top: 20px;">
        <h3>Especificaciones Técnicas y Características:</h3>
        <ul style="line-height: 1.8; margin-top: 10px;">
            <li><strong>Año:</strong> <?= $auto['anio'] ?></li>
            <li><strong>Kilómetros:</strong> <?= number_format($auto['kilometros']) ?> km</li>
            <li><strong>Transmisión:</strong> <?= htmlspecialchars($auto['transmision']) ?></li>
            <li><strong>Combustible:</strong> <?= htmlspecialchars($auto['combustible']) ?></li>
            <li><strong>Descripción / Detalles:</strong><br><p style="margin-top: 5px; color: #555;"><?= nl2br(htmlspecialchars($auto['descripcion'])) ?></p></li>
        </ul>
        <br>
        <div style="display: flex; gap: 10px;">
            <a href="contacto.php" class="btn" style="background: #28a745; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Consultar por este Auto ✉️</a>
            <a href="catalogo.php" class="btn" style="background: #6c757d; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Volver al Catálogo</a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>