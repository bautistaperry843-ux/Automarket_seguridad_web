<?php
$titulo_pagina = "Registro de Usuario - AutoMarket";
require_once __DIR__ . '/includes/header.php';

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Requisito OWASP: Sanitización de entradas contra XSS
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $email  = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $raw_password = trim($_POST['password']);

    if (!empty($nombre) && !empty($email) && !empty($raw_password)) {
        // 1. Verificación previa de correo existente
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $res_check = $check->get_result();

        if ($res_check->num_rows > 0) {
            $mensaje = "El correo electrónico ya se encuentra registrado.";
            $tipo_alerta = "red";
        } else {
            // 2. Requisito OWASP: Hashing seguro PASSWORD_BCRYPT
            $password = password_hash($raw_password, PASSWORD_BCRYPT);
            $rol_default = 'usuario';

            // 3. Inserción con consulta preparada
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $email, $password, $rol_default);

            if ($stmt->execute()) {
                $mensaje = "¡Registro exitoso! Ya podés <a href='inicio de sesion.php' style='color: #155724; font-weight: bold;'>Iniciar Sesión</a>.";
                $tipo_alerta = "green";
            } else {
                $mensaje = "Hubo un error al procesar la solicitud.";
                $tipo_alerta = "red";
            }
        }
    } else {
        $mensaje = "Por favor, complete todos los campos requeridos.";
        $tipo_alerta = "red";
    }
}
?>

<main class="auth-page">
    <section class="auth-card">
        <div class="auth-header">
            <span class="auth-badge">Registro</span>
            <h2>Crear Cuenta</h2>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p class="auth-alert <?= $tipo_alerta === 'green' ? 'success' : 'error' ?>"><?= $mensaje ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <p>
                <label for="nombre">Nombre completo</label><br>
                <input id="nombre" type="text" name="nombre" required>
            </p>
            <p>
                <label for="email">Correo electrónico</label><br>
                <input id="email" type="email" name="email" required>
            </p>
            <p>
                <label for="password">Contraseña</label><br>
                <input id="password" type="password" name="password" required>
            </p>
            <button type="submit" class="btn btn-full">Registrarme</button>
        </form>

        <p class="auth-footer">¿Ya tenés una cuenta? <a href="inicio de sesion.php">Iniciá sesión acá</a></p>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>