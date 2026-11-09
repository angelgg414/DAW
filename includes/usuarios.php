<?php
/* Acceso a los usuarios registrados. Las páginas usan estas funciones, nunca el fichero de datos. */

/**
 * Indica si $usuario existe y $clave coincide con su contraseña.
 */
function credencialesValidas(string $usuario, string $clave): bool
{
    $ruta = __DIR__ . '/../datos/usuarios.php';
    if (!is_readable($ruta)) {
        throw new RuntimeException('No se puede leer el fichero de usuarios.');
    }
    $usuarios = require $ruta;

    return isset($usuarios[$usuario]) && password_verify($clave, $usuarios[$usuario]);
}