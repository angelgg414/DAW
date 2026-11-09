<?php
/*
 * Folleto publicitario: tarifas y cálculo del coste.
 * Son las mismas tarifas que aplica js/folleto.js (práctica 6), ahora calculadas en el servidor.
 */

// Tarifas en euros. Las páginas se cobran por bloques, como los tramos de una factura de agua.
const TARIFAS_FOLLETO = [
    'envio'                => 10.0, // procesamiento y envío
    'pagina_bloque_1'      => 2.0,  // páginas 1 a 4
    'pagina_bloque_2'      => 1.8,  // páginas 5 a 10
    'pagina_bloque_3'      => 1.6,  // páginas 11 en adelante
    'foto_color'           => 0.5,  // por foto, si se imprime a color
    'foto_alta_resolucion' => 0.2,  // por foto, si la resolución es mayor de 300 dpi
];

// Resoluciones que ofrece el formulario (dpi)
const RESOLUCIONES_FOLLETO = [150, 300, 450, 600, 750, 900];

// Valores ficticios hasta que haya base de datos con las páginas y fotos de cada anuncio
const PAGINAS_FICTICIAS = 5;
const FOTOS_FICTICIAS   = 15;

/**
 * Indica si una resolución tiene el suplemento de alta resolución (más de 300 dpi).
 */
function esAltaResolucion(int $dpi): bool
{
    return $dpi > 300;
}

/**
 * Coste de un folleto (una copia) según páginas, fotos, color y resolución.
 */
function calcularCosteFolleto(int $paginas, int $fotos, bool $color, bool $altaResolucion): float
{
    $bloque1 = min($paginas, 4);
    $bloque2 = min(max($paginas - 4, 0), 6);
    $bloque3 = max($paginas - 10, 0);

    $coste = TARIFAS_FOLLETO['envio']
        + $bloque1 * TARIFAS_FOLLETO['pagina_bloque_1']
        + $bloque2 * TARIFAS_FOLLETO['pagina_bloque_2']
        + $bloque3 * TARIFAS_FOLLETO['pagina_bloque_3'];

    if ($color) {
        $coste += $fotos * TARIFAS_FOLLETO['foto_color'];
    }
    if ($altaResolucion) {
        $coste += $fotos * TARIFAS_FOLLETO['foto_alta_resolucion'];
    }

    return $coste;
}
