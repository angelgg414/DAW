<?php
/*
 * "Últimos anuncios visitados".
 * Cookie de 1 semana con los ids de los 4 últimos anuncios visitados por cada usuario, en orden de visita.
 * Solo guarda ids, nunca títulos ni precios: los datos se leen siempre del servidor.
 * Formato JSON: {"usuarios": {"mariagarcia": [3, 1, 4]}, "ultimo": "mariagarcia"}
 */

const COOKIE_ULTIMOS   = 'ultimos';
const DURACION_ULTIMOS = 7 * 24 * 60 * 60;   // 1 semana en segundos
const MAX_ULTIMOS      = 4;

/**
 * Contenido de la cookie, validado: el usuario puede modificarla, así que solo se aceptan
 * nombres de usuario de texto y, por usuario, como mucho 4 ids de anuncios que existan.
 */
function leerCookieUltimos(): array
{
    $limpio = ['usuarios' => [], 'ultimo' => null];

    $crudo = $_COOKIE[COOKIE_ULTIMOS] ?? '';
    $datos = is_string($crudo) ? json_decode($crudo, true) : null;
    if (!is_array($datos)) {
        return $limpio;
    }

    $anuncios = obtenerAnuncios();   // solo se aceptan ids de anuncios que existen
    if (isset($datos['usuarios']) && is_array($datos['usuarios'])) {
        foreach ($datos['usuarios'] as $usuario => $ids) {
            if (is_string($usuario) && is_array($ids)) {
                $ids = array_values(array_filter($ids, fn ($id) => is_int($id) && isset($anuncios[$id])));
                $limpio['usuarios'][$usuario] = array_slice($ids, -MAX_ULTIMOS);
            }
        }
    }
    if (isset($datos['ultimo']) && is_string($datos['ultimo'])) {
        $limpio['ultimo'] = $datos['ultimo'];
    }

    return $limpio;
}

function guardarCookieUltimos(array $datos): void
{
    $json = json_encode($datos);
    setcookie(COOKIE_ULTIMOS, $json, opcionesCookie(time() + DURACION_ULTIMOS));
    $_COOKIE[COOKIE_ULTIMOS] = $json;   // para que el panel de esta misma página ya lo muestre
}

/**
 * Anota la visita al anuncio $id del usuario actual: si ya estaba, se mueve al final;
 * si hay más de 4, se quita el más antiguo.
 */
function registrarVisita(int $id): void
{
    $usuario = usuarioActual();
    if ($usuario === null) {
        return;
    }

    $datos = leerCookieUltimos();
    $ids   = array_values(array_diff($datos['usuarios'][$usuario] ?? [], [$id]));
    $ids[] = $id;

    $datos['usuarios'][$usuario] = array_slice($ids, -MAX_ULTIMOS);
    $datos['ultimo'] = $usuario;
    guardarCookieUltimos($datos);
}

/**
 * Ids que muestra el panel: los del usuario de la sesión o, sin sesión,
 * los del último usuario que navegó en este equipo.
 */
function idsUltimos(): array
{
    $datos   = leerCookieUltimos();
    $usuario = usuarioActual() ?? $datos['ultimo'];
    return $usuario === null ? [] : ($datos['usuarios'][$usuario] ?? []);
}

function borrarUltimos(): void
{
    setcookie(COOKIE_ULTIMOS, '', opcionesCookie(time() - 3600));
}
