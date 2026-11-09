<?php
/*
 * Funciones comunes a todas las páginas del sitio.
 */

/**
 * Escapa un valor para mostrarlo de forma segura dentro de HTML (evita XSS).
 */
function e(?string $valor): string
{
    if ($valor === null) {
        return '';
    }
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Genera un elemento <li> de un menú de navegación.
 * Marca con aria-current="page" el enlace que corresponde a la página actual.
 * $icono es la entidad del icono de Material Symbols (valor fijo del código, no del usuario).
 */
function itemMenu(string $archivo, string $icono, string $texto): string
{
    $paginaActual = basename($_SERVER['SCRIPT_NAME']);
    $actual = ($paginaActual === $archivo) ? ' aria-current="page"' : '';

    return '<li><a href="' . e($archivo) . '"' . $actual . '>'
        . '<span class="material-symbols-outlined" aria-hidden="true">' . $icono . '</span> '
        . e($texto) . '</a></li>';
}

/**
 * Devuelve el texto recibido en $origen[$nombre] ($_POST o $_GET),
 * o '' si no existe o no es texto (por ejemplo, si alguien manipula el formulario y envía un array).
 */
function textoRecibido(array $origen, string $nombre): string
{
    return (isset($origen[$nombre]) && is_string($origen[$nombre])) ? $origen[$nombre] : '';
}

/**
 * Redirige a una página del sitio usando una URL absoluta y termina la ejecución.
 * $parametros se añade como cadena de consulta (?clave=valor&...).
 */
function redirigir(string $pagina, array $parametros = []): never
{
    $protocolo  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host       = $_SERVER['HTTP_HOST'];
    $directorio = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $url = "$protocolo://$host$directorio/$pagina";
    if ($parametros) {
        $url .= '?' . http_build_query($parametros);
    }

    header("Location: $url", true, 303);
    exit;
}