<?php
/* Acceso a los anuncios. Las páginas usan estas funciones, nunca el fichero de datos. */

function obtenerAnuncios(): array
{
    $ruta = __DIR__ . '/../datos/anuncios.php';
    if (!is_readable($ruta)) {
        throw new RuntimeException('No se puede leer el fichero de anuncios.');
    }
    return require $ruta;
}

/*
 * Anuncio de los datos de ejemplo que corresponde a $id: el propio si existe; si no,
 * como en la práctica 7, un id impar corresponde al anuncio 1 y uno par al anuncio 2.
 */
function claveAnuncioEjemplo(int $id): int
{
    if (isset(obtenerAnuncios()[$id])) {
        return $id;
    }
    return ($id % 2 === 0) ? 2 : 1;
}

/* Anuncios publicados por $usuario (los que ve en "Mis anuncios"). */
function obtenerAnunciosDeUsuario(string $usuario): array
{
    return array_filter(obtenerAnuncios(), fn ($anuncio) => $anuncio['usuario'] === $usuario);
}

/* Devuelve el anuncio que corresponde a $id (según su paridad). Conserva el id pedido. */
function obtenerAnuncio(int $id): array
{
    $anuncio = obtenerAnuncios()[claveAnuncioEjemplo($id)];
    $anuncio['id'] = $id;
    return $anuncio;
}

/**
 * Precio listo para mostrar: "245.000 €", o "950 €/mes" si el anuncio es de alquiler.
 */
function formatearPrecio(array $anuncio): string
{
    $precio = formatearEuros($anuncio['precio'], 0);
    return $anuncio['tipo_anuncio'] === 'Alquiler' ? $precio . '/mes' : $precio;
}

/**
 * Características del anuncio con su etiqueta y unidades: etiqueta => valor visible.
 */
function caracteristicasVisibles(array $anuncio): array
{
    $c = $anuncio['caracteristicas'];
    return [
        'Superficie'          => $c['superficie'] . ' m²',
        'Habitaciones'        => (string) $c['habitaciones'],
        'Baños'               => (string) $c['banos'],
        'Planta'              => (string) $c['planta'],
        'Año de construcción' => (string) $c['anio'],
    ];
}
