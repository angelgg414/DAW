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