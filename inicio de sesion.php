<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo_pagina = "Iniciar Sesión - AutoMarket";
require_once __DIR__ . '/includes/header.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Requisito: Consulta preparada seleccionando id, nombre, password y ROL
    $stmt = $conn->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($user = $res->fetch_assoc()) {
        // Requisito OWASP: Validación con password_verify
        if (password_verify($password, $user['password'])) {
            
            // Requisito OWASP / TP8: Mitigar Session Fixation
            session_regenerate_id(true);

            // Requisito TP8: Persistencia en la superglobal $_SESSION
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];

            // Alerta de bienvenida temporal para el index
            $_SESSION['alerta_bienvenida'] = "¡Bienvenido de nuevo, " . $user['nombre'] . "!";

            // Requisito: Redirección automática según rol
            if ($user['rol'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "El correo no está registrado.";
    }
}
?>

<main class="auth-page">
    <section class="auth-card">
        <div class="auth-header">
            <span class="auth-badge">Acceso</span>
            <h2>Iniciá Sesión</h2>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p class="auth-alert error"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <p>
                <label for="email">Email</label><br>
                <input id="email" type="email" name="email" required>
            </p>
            <p>
                <label for="password">Contraseña</label><br>
                <input id="password" type="password" name="password" required>
            </p>
            <button type="submit" class="btn btn-full">Ingresar</button>
        </form>

        <p class="auth-footer">¿No tenés una cuenta? <a href="registro.php">Registrate acá</a></p>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>