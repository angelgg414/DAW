<?php
/*
 * Sesión del usuario y mensajes flash (flashdata).
 * Se incluye antes de generar cualquier salida: session_start() envía una cookie,
 * que es una cabecera HTTP, y las cabeceras solo se pueden enviar antes del HTML.
 */

// Cookie de la sesión: solo accesible por HTTP (no desde JavaScript), no se envía desde otros sitios
// y, si la conexión es https, solo viaja cifrada. Dura hasta que se cierra el navegador.
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
    'secure'   => conexionSegura(),
]);
session_start();

/**
 * Nombre del usuario que ha iniciado sesión, o null si no hay nadie.
 */
function usuarioActual(): ?string
{
    return $_SESSION['usuario'] ?? null;
}

/**
 * Guarda un dato que solo estará disponible en la siguiente página (flashdata).
 */
function ponerFlash(string $clave, mixed $valor): void
{
    $_SESSION['flash'][$clave] = $valor;
}

/**
 * Lee un dato flash y lo borra en el mismo momento: solo se puede usar una vez.
 */
function tomarFlash(string $clave, mixed $porDefecto = null): mixed
{
    $valor = $_SESSION['flash'][$clave] ?? $porDefecto;
    unset($_SESSION['flash'][$clave]);
    return $valor;
}