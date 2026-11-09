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

/* Id impar -> anuncio 1, id par -> anuncio 2. Conserva el id pedido. */
function obtenerAnuncio(int $id): array
{
    $anuncios = obtenerAnuncios();
    $anuncio = ($id % 2 === 0) ? $anuncios[2] : $anuncios[1];
    $anuncio['id'] = $id;
    return $anuncio;
}