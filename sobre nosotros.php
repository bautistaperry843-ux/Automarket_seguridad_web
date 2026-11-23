<?php
$titulo_pagina = "Quiénes Somos - AutoMarket";
require_once __DIR__ . '/includes/header.php';
?>

<main style="padding: 20px; max-width: 900px; margin: 0 auto;">
    <section class="hero-section" style="text-align: center; margin-bottom: 30px;">
        <img src="foto de auto.jfif" alt="Oficinas corporativas" style="max-width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">
        <h2 style="margin-top: 15px;">AutoMarket Salta - Trayectoria y Compromiso</h2>
    </section>

    <section class="card" style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 25px;">
        <h2>Acerca de Nuestra Empresa</h2>
        <p style="line-height: 1.6; margin-top: 10px;">Somos una empresa líder nacida en Salta dedicada a conectar a compradores y vendedores de vehículos de forma rápida, segura y transparente. Contamos con años de experiencia en el mercado automotor regional, garantizando operaciones confiables y asesoramiento personalizado en cada etapa.</p>
        <p style="line-height: 1.6; margin-top: 10px;">Nuestra misión es facilitar el acceso al auto de tus sueños brindándote herramientas digitales modernas, un catálogo actualizado en tiempo real y un riguroso control técnico de cada unidad publicada.</p>
    </section>

    <section class="card" style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
        <h2>Nuestro Equipo de Trabajo</h2>
        <p style="margin-bottom: 20px;">Conocé a los profesionales que forman parte de AutoMarket y trabajan día a día para brindarte el mejor servicio:</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div style="border: 1px solid #eee; padding: 15px; border-radius: 6px; text-align: center; background: #fdfdfd;">
                <h3 style="color: #007bff; margin-bottom: 5px;">Bautista Salto Perry</h3>
                <p style="font-size: 0.9rem; font-weight: bold; color: #555;">Fundador y Director General</p>
                <p style="font-size: 0.85rem; margin-top: 8px;">Especialista en estrategia comercial y gestión de operaciones del sector automotor.</p>
            </div>
            
            <div style="border: 1px solid #eee; padding: 15px; border-radius: 6px; text-align: center; background: #fdfdfd;">
                <h3 style="color: #007bff; margin-bottom: 5px;">Marcos Artaza</h3>
                <p style="font-size: 0.9rem; font-weight: bold; color: #555;">Jefe de Taller y Mecánica</p>
                <p style="font-size: 0.85rem; margin-top: 8px;">Técnico en automotores encargado de la inspección y certificación mecánica de cada unidad.</p>
            </div>

            <div style="border: 1px solid #eee; padding: 15px; border-radius: 6px; text-align: center; background: #fdfdfd;">
                <h3 style="color: #007bff; margin-bottom: 5px;">Lucía Gómez</h3>
                <p style="font-size: 0.9rem; font-weight: bold; color: #555;">Atención al Cliente y Gestoría</p>
                <p style="font-size: 0.85rem; margin-top: 8px;">Encargada de asesoramiento a compradores y trámites de transferencia rápida.</p>
            </div>
        </div>

        <p style="margin-top: 25px;">Si tenés alguna duda sobre nuestro servicio, te invitamos a visitar la página de <a href="preguntas frecuentes.php" style="color: #007bff; font-weight: bold;">Preguntas Frecuentes</a> o escribirnos desde nuestro formulario de <a href="contacto.php" style="color: #007bff; font-weight: bold;">Contacto</a>.</p>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>