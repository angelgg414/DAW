<?php
/*
 * Funciones comunes a todas las páginas del sitio.
 */

// Zona horaria del sitio: las fechas no dependen de la configuración del servidor.
date_default_timezone_set('Europe/Madrid');

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

/**
 * Países que se pueden elegir en los formularios: código => nombre.
 * Una sola lista para todo el sitio (registro, búsqueda, folleto...).
 */
function obtenerPaises(): array
{
    return [
        'DE' => 'Alemania',  'AR' => 'Argentina', 'BE' => 'Bélgica',      'CL' => 'Chile',
        'CO' => 'Colombia',  'ES' => 'España',    'FR' => 'Francia',      'IT' => 'Italia',
        'MX' => 'México',    'NL' => 'Países Bajos', 'PT' => 'Portugal',  'GB' => 'Reino Unido',
    ];
}

/**
 * Opciones de sexo del formulario de registro: valor => texto visible.
 */
function obtenerSexos(): array
{
    return ['mujer' => 'Mujer', 'hombre' => 'Hombre', 'otro' => 'Otro'];
}

/**
 * Atributos de accesibilidad para un control con error:
 * aria-invalid lo marca como erróneo y aria-describedby lo asocia a su mensaje.
 * Devuelve '' si no hay error.
 */
function atributosError(?string $error, string $idCampo): string
{
    return $error === null ? '' : ' aria-invalid="true" aria-describedby="error-' . e($idCampo) . '"';
}

/**
 * Devuelve el entero positivo recibido en $origen[$nombre], o null si falta o no es válido.
 */
function idRecibido(array $origen, string $nombre): ?int
{
    $id = filter_var(textoRecibido($origen, $nombre), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

/**
 * Tipos de mensaje que se pueden enviar a un anunciante: valor => texto visible.
 */
function obtenerTiposMensaje(): array
{
    return ['oferta' => 'Comunicar una oferta', 'informacion' => 'Más información', 'cita' => 'Solicitar una cita'];
}

/**
 * Tipos de anuncio: valor => texto visible.
 */
function obtenerTiposAnuncio(): array
{
    return ['venta' => 'Venta', 'alquiler' => 'Alquiler'];
}

/**
 * Tipos de vivienda: valor => texto visible.
 */
function obtenerTiposVivienda(): array
{
    return [
        'garaje'     => 'Garaje',
        'local'      => 'Local',
        'obra-nueva' => 'Obra nueva',
        'oficina'    => 'Oficina',
        'vivienda'   => 'Vivienda',
    ];
}

/**
 * Importe en euros con formato español: formatearEuros(1234.5) => "1.234,50 €".
 */
function formatearEuros(float $importe, int $decimales = 2): string
{
    return number_format($importe, $decimales, ',', '.') . ' €';
}

/**
 * Convierte una fecha AAAA-MM-DD en texto ("27 de septiembre de 2026").
 * Devuelve null si la fecha no es válida (por ejemplo, 2026-02-31).
 */
function formatearFecha(string $fechaIso): ?string
{
    $fecha = DateTimeImmutable::createFromFormat('!Y-m-d', $fechaIso);
    if ($fecha === false || $fecha->format('Y-m-d') !== $fechaIso) {
        return null;
    }

    $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
              'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

    return $fecha->format('j') . ' de ' . $meses[(int) $fecha->format('n') - 1] . ' de ' . $fecha->format('Y');
}