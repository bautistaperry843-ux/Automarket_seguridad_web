<?php
$titulo_pagina = "Publicá tu auto - AutoMarket";
require_once __DIR__ . '/includes/header.php';

$mensaje = "";
$mensaje_tipo = "";
$requiere_login = false;
$publicacion_exitosa = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id'])) {
        $mensaje = "Iniciá sesión para publicar un vehículo.";
        $mensaje_tipo = "error";
        $requiere_login = true;
    } else {
        $usuario_id  = $_SESSION['usuario_id'];
        $titulo      = trim($_POST['titulo']);
        $precio      = floatval($_POST['precio']);
        $anio        = intval($_POST['anio']);
        $kilometros  = intval($_POST['kilometros']);
        $transmision = trim($_POST['transmision']);
        $combustible = trim($_POST['combustible']);
        $descripcion = trim($_POST['descripcion']);

        $nombre_foto = "default.jpg";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nombre_foto = time() . '_' . uniqid() . '.' . $ext;
            if (!is_dir(__DIR__ . '/uploads')) {
                mkdir(__DIR__ . '/uploads', 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/uploads/' . $nombre_foto);
        }

        $stmt = $conn->prepare("INSERT INTO vehiculos (usuario_id, titulo, precio, anio, kilometros, transmision, combustible, descripcion, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdiissss", $usuario_id, $titulo, $precio, $anio, $kilometros, $transmision, $combustible, $descripcion, $nombre_foto);

        if ($stmt->execute()) {
            $mensaje = "Tu vehículo se publicó correctamente.";
            $mensaje_tipo = "success";
            $publicacion_exitosa = true;
        } else {
            $mensaje = "Error al publicar el vehículo.";
            $mensaje_tipo = "error";
        }
    }
}

$autor = "AutoMarket";
$anio_actual = date('Y');
?>

<main class="sell-main">
    <section class="sell-intro">
        <span class="sell-eyebrow">PUBLICACIÓN DE VEHÍCULOS</span>
        <h2>Publicá tu auto</h2>
        <p>Completá los datos principales y prepará una publicación clara para quienes buscan su próximo vehículo.</p>
    </section>

    <?php if ($mensaje !== ""): ?>
        <div class="sell-alert <?= htmlspecialchars($mensaje_tipo, ENT_QUOTES, 'UTF-8') ?>" role="status">
            <span><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></span>
            <?php if ($requiere_login): ?>
                <a href="inicio de sesion.php">Iniciar sesión</a>
            <?php elseif ($publicacion_exitosa): ?>
                <a href="catalogo.php">Ver catálogo</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="sell-layout">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <form class="card sell-form" action="" method="POST" enctype="multipart/form-data">
                <div class="sell-form-heading">
                    <h3>Datos del vehículo</h3>
                    <p>Los campos marcados son necesarios para publicar.</p>
                </div>

                <div class="sell-form-grid">
                    <label class="sell-field sell-field-wide" for="titulo">
                        Título o modelo
                        <input type="text" id="titulo" name="titulo" placeholder="Ej.: Toyota Corolla XEI" required>
                    </label>

                    <label class="sell-field" for="precio">
                        Precio (USD)
                        <input type="number" id="precio" name="precio" min="0" step="0.01" placeholder="Ej.: 18500" required>
                    </label>

                    <label class="sell-field" for="anio">
                        Año
                        <input type="number" id="anio" name="anio" min="1900" max="<?= (int) date('Y') + 1 ?>" placeholder="Ej.: 2022" required>
                    </label>

                    <label class="sell-field" for="kilometros">
                        Kilómetros
                        <input type="number" id="kilometros" name="kilometros" min="0" placeholder="Ej.: 45000" required>
                    </label>

                    <label class="sell-field" for="transmision">
                        Transmisión
                        <select id="transmision" name="transmision">
                    <option value="Manual">Manual</option>
                    <option value="Automática">Automática</option>
                        </select>
                    </label>

                    <label class="sell-field" for="combustible">
                        Combustible
                        <select id="combustible" name="combustible">
                    <option value="Nafta">Nafta</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Híbrido/Eléctrico">Híbrido/Eléctrico</option>
                        </select>
                    </label>

                    <label class="sell-field sell-field-wide" for="descripcion">
                        Descripción y características
                        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Contá sobre el equipamiento, el estado del vehículo y la documentación."></textarea>
                    </label>
                </div>

                <div class="sell-photo-section">
                    <div>
                        <h3>Foto principal</h3>
                        <p>Elegí una imagen nítida del vehículo.</p>
                    </div>
                    <div class="upload-file-wrap">
                        <label for="input-foto" class="custom-file-btn">Seleccionar imagen</label>
                        <input type="file" name="foto" id="input-foto" accept="image/*" required>
                        <span class="file-name" id="file-name">Ninguna imagen seleccionada</span>
                    </div>
                    <img id="vista-previa" class="sell-photo-preview" src="#" alt="Vista previa de la foto seleccionada" hidden>
                </div>

                <div class="sell-form-actions">
                    <span>Revisá los datos antes de publicar.</span>
                    <button type="submit" class="btn">Publicar auto</button>
                </div>
            </form>
        <?php else: ?>
            <section class="card sell-login-panel">
                <h3>Iniciá sesión para publicar</h3>
                <p>Ingresá a tu cuenta para cargar los datos y las fotos de tu vehículo.</p>
                <a href="inicio de sesion.php" class="btn">Iniciar sesión</a>
            </section>
        <?php endif; ?>

        <aside class="sell-aside">
            <section class="sell-aside-section">
                <h3>Una publicación completa</h3>
                <ul>
                    <li>Usá un título con marca, modelo y versión.</li>
                    <li>Indicá el kilometraje y el año con precisión.</li>
                    <li>Detallá el equipamiento y el estado general.</li>
                    <li>Elegí una foto clara y actual del vehículo.</li>
                </ul>
            </section>
            <section class="sell-aside-section">
                <h3>Después de publicar</h3>
                <p>Tu vehículo estará disponible en el catálogo para que las personas interesadas puedan consultarlo.</p>
                <a href="../preguntas frecuentes.php" class="admin-inline-link">Ver preguntas frecuentes</a>
            </section>
        </aside>
    </div>
</main>

<script>
    const inputFoto = document.getElementById('input-foto');
    const fileName = document.getElementById('file-name');
    const preview = document.getElementById('vista-previa');

    if (inputFoto && fileName && preview) {
        inputFoto.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                fileName.textContent = file.name;
                preview.src = URL.createObjectURL(file);
                preview.hidden = false;
            } else {
                fileName.textContent = 'Ninguna imagen seleccionada';
                preview.hidden = true;
            }
        });
    }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>