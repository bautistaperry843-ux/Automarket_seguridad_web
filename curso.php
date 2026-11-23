<?php
$titulo_pagina = "Curso Mecánica Básica - AutoMarket";
require_once __DIR__ . '/includes/header.php';
?>

<main>
    <h2>Temario Completo del Curso</h2>
    <p>Este curso práctico está diseñado para compradores particulares que quieran evitar estafas y detectar fallas mecánicas ocultas antes de realizar una oferta de compra.</p>

    <details class="terms-box">
        <summary><strong>Módulo 1: Revisión General del Motor y Fluidos ▾</strong></summary>
        <ul>
            <li>Control del nivel y textura del aceite (detección de agua o restos metálicos).</li>
            <li>Verificación del depósito de líquido refrigerante y búsqueda de fugas en mangueras.</li>
            <li>Prueba de encendido en frío: ruidos de válvulas, tensor de distribución y alternador.</li>
            <li>Identificación del humo del escape: azul (aceite), blanco (refrigerante) o negro (mala combustión).</li>
        </ul>
    </details>

    <details class="terms-box">
        <summary><strong>Módulo 2: Chasis, Estructura y Carrocería ▾</strong></summary>
        <ul>
            <li>Detección de masilla y repintados mediante diferencia de tono o luz reflectante.</li>
            <li>Revisión de parantes, zócalos y baúl para confirmar la ausencia de choques estructurales.</li>
            <li>Verificación del estado de los neumáticos, desgaste irregular y fecha de fabricación (DOT).</li>
        </ul>
    </details>

    <details class="terms-box">
        <summary><strong>Módulo 3: Sistema Eléctrico, Suspensión y Prueba de Manejo ▾</strong></summary>
        <ul>
            <li>Testeo de aire acondicionado, levanta cristales, instrumental y luces en tablero.</li>
            <li>Evaluación de amortiguadores, bujes, cazoletas y tren delantero en movimiento.</li>
            <li>Comprobación de la caja de cambios: acople de marchas, dureza del pedal de embrague y frenado.</li>
        </ul>
    </details>

    <section class="support-box">
        <h3>Inscripción al Curso</h3>
        <p>Modalidad: <strong>100% Online (Acceso de por vida)</strong></p>
        <p>Precio: <strong class="price">$15,00 USD</strong></p>
        <form>
            <p>Tu Nombre Completo:<br><input type="text" style="width: 100%;"></p>
            <p>Tu Email de Contacto:<br><input type="email" style="width: 100%;"></p>
            <details class="user-login">
                <summary class="btn-sub">Solicitar Inscripción</summary>
                <p class="success-msg"><strong>Solicitud enviada. Te contactaremos por email.</strong></p>
            </details>
        </form>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>