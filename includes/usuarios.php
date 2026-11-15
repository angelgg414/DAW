<?php
/* Acceso a los usuarios registrados. Las páginas usan estas funciones, nunca el fichero de datos. */

/**
 * Datos de un usuario (clave y estilo), o null si no existe.
 */
function obtenerUsuario(string $usuario): ?array
{
    $ruta = __DIR__ . '/../datos/usuarios.php';
    if (!is_readable($ruta)) {
        throw new RuntimeException('No se puede leer el fichero de usuarios.');
    }
    $usuarios = require $ruta;

    return $usuarios[$usuario] ?? null;
}

/**
 * Indica si $usuario existe y $clave coincide con su contraseña.
 */
function credencialesValidas(string $usuario, string $clave): bool
{
    $datos = obtenerUsuario($usuario);
    return $datos !== null && password_verify($clave, $datos['clave']);
}
