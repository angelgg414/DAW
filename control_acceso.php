<?php
/*
 * Control de acceso (página no visible).
 * Valida el formulario de acceso y redirige a la parte privada o al formulario con un error.
 * El error se pasa a la página siguiente como flashdata (en la sesión).
 */
require_once __DIR__ . '/includes/arranque.php';
require_once __DIR__ . '/includes/usuarios.php';

// Solo se llega aquí enviando el formulario; cualquier otro acceso vuelve al login.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('login.php');
}

$usuario = trim(textoRecibido($_POST, 'usuario'));
$clave   = textoRecibido($_POST, 'clave');

// Misma validación que hacía el JavaScript: campos con contenido, no solo espacios o tabuladores.
if ($usuario === '' || trim($clave) === '') {
    ponerFlash('error_acceso', 'vacio');
    redirigir('login.php');
}

if (!credencialesValidas($usuario, $clave)) {
    ponerFlash('error_acceso', 'credenciales');
    ponerFlash('usuario_acceso', $usuario);   // para no obligar a escribirlo otra vez
    redirigir('login.php');
}

// Acceso correcto: identificador de sesión nuevo (evita la fijación de sesión) y usuario en la sesión
session_regenerate_id(true);
$_SESSION['usuario'] = $usuario;

// Si se venía de una página protegida, se vuelve a ella; si no, al menú del usuario
$destino = $_SESSION['volver_a'] ?? 'indexlogueado.php';
unset($_SESSION['volver_a']);
redirigir($destino);