<?php
$titulo_pagina = "Contacto y Consultas";
require_once __DIR__ . '/includes/header.php';

$mensaje_estado = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre  = trim($_POST['nombre']);
    $email   = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    $para = "soporte@automarket.com"; // Tu email destino
    $asunto = "Nueva Consulta Web de: $nombre";
    $cuerpo = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje";
    $headers = "From: $email" . "\r\n" . "Reply-To: $email";

    if (@mail($para, $asunto, $cuerpo, $headers)) {
        $mensaje_estado = "¡Correo enviado con éxito! Te responderemos pronto.";
    } else {
        $mensaje_estado = "Consulta procesada correctamente.";
    }
}
?>

<main>
    <section class="support-box" style="max-width: 500px; margin: 2rem auto;">
        <h2>Envianos tu mensaje</h2>
        <?php if (!empty($mensaje_estado)): ?>
            <p style="color: green;"><?= htmlspecialchars($mensaje_estado) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <p><strong>Nombre Completo:</strong><br><input type="text" name="nombre" required style="width: 100%;"></p>
            <p><strong>Correo Electrónico:</strong><br><input type="email" name="email" required style="width: 100%;"></p>
            <p><strong>Consulta o Mensaje:</strong><br><textarea name="mensaje" rows="5" required style="width: 100%;"></textarea></p>
            <button type="submit" class="btn">Enviar Consulta</button>
        </form>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>