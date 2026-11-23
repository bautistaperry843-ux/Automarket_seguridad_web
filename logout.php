<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Requisito TP8: Unset de la superglobal $_SESSION
$_SESSION = array();

// 2. Requisito TP8: Eliminación estricta de las cookies de sesión del navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 3. Requisito TP8: Destrucción completa de la sesión
session_destroy();

// 4. Redirección al login
header("Location: inicio de sesion.php?status=logout");
exit;
?>