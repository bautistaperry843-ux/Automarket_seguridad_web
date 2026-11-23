<?php
// Carga sencilla de variables de entorno desde .env
function cargarEnv($ruta) {
    if (!file_exists($ruta)) {
        return;
    }
    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        if (strpos(trim($linea), '#') === 0) continue;
        list($clave, $valor) = explode('=', $linea, 2);
        $clave = trim($clave);
        $valor = trim(trim($valor), '"\'');
        $_ENV[$clave] = $valor;
    }
}

cargarEnv(__DIR__ . '/../.env');

// Asignación de variables por defecto con fallback
$app_name      = $_ENV['APP_NAME']      ?? 'AutoMarket';
$support_email = $_ENV['SUPPORT_EMAIL'] ?? 'contacto@automarket.com';
$sucursal      = $_ENV['BRANCH_ADDRESS'] ?? 'Av. Bicentenario 1200';
$autor         = $_ENV['AUTHOR_NAME']   ?? 'BAUTISTA SALTO PERRY';
$anio_actual   = $_ENV['CURRENT_YEAR']   ?? date('Y');
?>