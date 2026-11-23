<?php
$titulo_pagina = "Catálogo de Vehículos";
require_once __DIR__ . '/includes/header.php';

// Procesar agregado o quitado de Favoritos
if (isset($_GET['fav'])) {
    if (isset($_SESSION['usuario_id'])) {
        $v_id = intval($_GET['fav']);
        $u_id = $_SESSION['usuario_id'];
        
        $check = $conn->prepare("SELECT id FROM favoritos WHERE usuario_id = ? AND vehiculo_id = ?");
        $check->bind_param("ii", $u_id, $v_id);
        $check->execute();
        $res_check = $check->get_result();
        
        if ($res_check->num_rows > 0) {
            $del = $conn->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND vehiculo_id = ?");
            $del->bind_param("ii", $u_id, $v_id);
            $del->execute();
        } else {
            $ins = $conn->prepare("INSERT INTO favoritos (usuario_id, vehiculo_id) VALUES (?, ?)");
            $ins->bind_param("ii", $u_id, $v_id);
            $ins->execute();
        }
        header("Location: catalogo.php");
        exit;
    } else {
        echo "<script>alert('Debes iniciar sesión para gestionar favoritos'); window.location.href='inicio de sesion.php';</script>";
    }
}

// Búsqueda por método GET sanitizada (Requerimiento de la Clase 5)
$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';
$busqueda_segura = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');

if (!empty($busqueda_segura)) {
    $stmt = $conn->prepare("SELECT * FROM vehiculos WHERE titulo LIKE ? ORDER BY id DESC");
    $param = "%" . $busqueda_segura . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conn->query("SELECT * FROM vehiculos ORDER BY id DESC");
}

$mis_favs = [];
if (isset($_SESSION['usuario_id'])) {
    $u_id = $_SESSION['usuario_id'];
    $f_res = $conn->query("SELECT vehiculo_id FROM favoritos WHERE usuario_id = $u_id");
    while ($f_row = $f_res->fetch_assoc()) {
        $mis_favs[] = $f_row['vehiculo_id'];
    }
}
?>

<main style="padding: 20px;">
    <h2 style="color: #b8860b;">Vehículos Disponibles</h2>

    <!-- Formulario de Búsqueda por GET con persistencia de datos en el input -->
    <form action="catalogo.php" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="q" placeholder="Buscar vehículo por nombre..." value="<?= $busqueda_segura ?>" style="padding: 6px; width: 250px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" class="btn" style="background: #ffc107; color: #000; font-weight: bold; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
        <?php if (!empty($busqueda_segura)): ?>
            <a href="catalogo.php" style="margin-left: 10px; color: #b8860b; text-decoration: underline; font-weight: bold;">Limpiar filtro</a>
        <?php endif; ?>
    </form>

    <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 260px)); gap: 20px; justify-content: start;">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($auto = $resultado->fetch_assoc()): 
                $es_fav = in_array($auto['id'], $mis_favs);
            ?>
                <div class="card" style="border: 1px solid #ddd; padding: 12px; border-radius: 8px; background: #fff; display: flex; flex-direction: column; justify-content: space-between; width: 250px;">
                    <a href="vehiculo.php?id=<?= $auto['id'] ?>" style="text-decoration: none; color: inherit;">
                        <!-- Relación de aspecto 1.2 de ancho y 1 de alto -->
                        <div style="width: 100%; aspect-ratio: 1.2 / 1; overflow: hidden; border-radius: 6px;">
                            <img src="uploads/<?= htmlspecialchars($auto['imagen']) ?>" alt="<?= htmlspecialchars($auto['titulo']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h3 style="font-size: 1.1rem; margin: 10px 0 5px; color: #b8860b;"><?= htmlspecialchars($auto['titulo']) ?></h3>
                        <p style="font-size: 0.85rem; color: #555; margin: 2px 0;"><strong>Año:</strong> <?= $auto['anio'] ?> | <strong>Km:</strong> <?= number_format($auto['kilometros']) ?></p>
                        <p style="font-size: 0.85rem; color: #555; margin: 2px 0;"><strong>Caja:</strong> <?= $auto['transmision'] ?> | <strong>Combustible:</strong> <?= $auto['combustible'] ?></p>
                        <div class="price" style="font-size: 1.1rem; font-weight: bold; color: #28a745; margin: 8px 0;">$<?= number_format($auto['precio'], 2) ?> USD</div>
                    </a>
                    
                    <div style="display: flex; gap: 8px; margin-top: 5px;">
                        <a href="vehiculo.php?id=<?= $auto['id'] ?>" class="btn" style="flex: 1; text-align: center; background: #ffc107; color: #000; font-weight: bold; padding: 6px; text-decoration: none; border-radius: 4px; font-size: 0.85rem;">Ver Ficha</a>
                        <a href="catalogo.php?fav=<?= $auto['id'] ?>" class="btn" style="background: <?= $es_fav ? '#dc3545' : '#ffc107' ?>; color: <?= $es_fav ? '#fff' : '#000' ?>; padding: 6px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85rem;" title="<?= $es_fav ? 'Quitar de favoritos' : 'Agregar a favoritos' ?>">
                            <?= $es_fav ? '❤️' : '⭐' ?>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron vehículos que coincidan con la búsqueda.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>