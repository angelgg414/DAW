<?php
/*
 * Control de acceso (página no visible).
 * Valida el formulario de acceso y redirige a la parte privada o al formulario con un error.
 * El error viaja por la URL: la práctica no permite cookies ni sesiones.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/usuarios.php';

// Solo se llega aquí enviando el formulario; cualquier otro acceso vuelve al login.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('login.php');
}

$usuario = trim(textoRecibido($_POST, 'usuario'));
$clave   = textoRecibido($_POST, 'clave');

// Misma validación que hacía el JavaScript: campos con contenido, no solo espacios o tabuladores.
if ($usuario === '' || trim($clave) === '') {
    redirigir('login.php', ['error' => 'vacio']);
}

if (!credencialesValidas($usuario, $clave)) {
    redirigir('login.php', ['error' => 'credenciales']);
}

redirigir('indexlogueado.php');