<?php
$titulo_pagina = "Mis Favoritos - AutoMarket";
require_once __DIR__ . '/includes/header.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "<main style='padding: 20px;'><p>Por favor <a href='inicio de sesion.php'>Iniciá sesión</a> para ver tus favoritos.</p></main>";
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$u_id = $_SESSION['usuario_id'];

// Procesar eliminación de favorito
if (isset($_GET['quitar'])) {
    $v_id = intval($_GET['quitar']);
    $del = $conn->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND vehiculo_id = ?");
    $del->bind_param("ii", $u_id, $v_id);
    $del->execute();
    header("Location: favoritos.php");
    exit;
}

$query = "SELECT v.* FROM favoritos f JOIN vehiculos v ON f.vehiculo_id = v.id WHERE f.usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $u_id);
$stmt->execute();
$favs = $stmt->get_result();
?>

<main style="padding: 20px;">
    <h2>Tus Vehículos Favoritos</h2>
    <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 260px)); gap: 20px; justify-content: start;">
        <?php if ($favs->num_rows > 0): ?>
            <?php while ($auto = $favs->fetch_assoc()): ?>
                <div class="card" style="border: 1px solid #ddd; padding: 12px; border-radius: 8px; background: #fff; display: flex; flex-direction: column; justify-content: space-between; width: 250px;">
                    <a href="vehiculo.php?id=<?= $auto['id'] ?>" style="text-decoration: none; color: inherit;">
                        <div style="width: 100%; aspect-ratio: 1.2 / 1; overflow: hidden; border-radius: 6px;">
                            <img src="uploads/<?= htmlspecialchars($auto['imagen']) ?>" alt="<?= htmlspecialchars($auto['titulo']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h3 style="font-size: 1.1rem; margin: 10px 0 5px;"><?= htmlspecialchars($auto['titulo']) ?></h3>
                        <p style="font-size: 0.85rem; color: #555; margin: 2px 0;"><strong>Precio:</strong> $<?= number_format($auto['precio'], 2) ?> USD</p>
                        <p style="font-size: 0.85rem; color: #555; margin: 2px 0;"><strong>Año:</strong> <?= $auto['anio'] ?></p>
                    </a>
                    <div style="margin-top: 10px;">
                        <a href="favoritos.php?quitar=<?= $auto['id'] ?>" class="btn" style="display: block; text-align: center; background: #dc3545; color: #fff; padding: 6px; text-decoration: none; border-radius: 4px; font-size: 0.85rem;">Quitar de favoritos ❌</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aún no tenés ningún vehículo guardado en favoritos.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>