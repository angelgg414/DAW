<?php
/*
 * Cabecera común: DOCTYPE y <head>.
 * Variables que define cada página antes de incluir este fichero:
 *   $titulo        (string, obligatoria)  título de la página
 *   $descripcion   (string, opcional)     contenido de la meta description
 *   $estilosExtra  (array,  opcional)     hojas de estilo propias de la página
 *   $scriptsExtra  (array,  opcional)     scripts propios de la página
 */
$descripcion  = $descripcion  ?? 'PI - Pisos & Inmuebles: anuncios de venta y alquiler de viviendas, oficinas, locales y garajes';
$estilosExtra = $estilosExtra ?? [];
$scriptsExtra = $scriptsExtra ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= e($descripcion) ?>">
  <title><?= e($titulo) ?> - PI Pisos &amp; Inmuebles</title>
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/estructura.css">
  <link rel="stylesheet" href="css/formularios.css">
  <link rel="stylesheet" href="css/tablas.css">
  <link rel="stylesheet" href="css/adaptativo.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&amp;display=block">
  <!-- Estilo del usuario (preferido) y estilos alternativos: Ver > Estilo de página en Firefox -->
<?php foreach (obtenerEstilos() as $claveEstilo => $datosEstilo): ?>
<?php foreach ($datosEstilo['hojas'] as $hoja): ?>
  <link rel="<?= $claveEstilo === estiloActual() ? 'stylesheet' : 'alternate stylesheet' ?>" href="<?= e($hoja) ?>" media="screen" title="<?= e($datosEstilo['titulo']) ?>">
<?php endforeach; ?>
<?php endforeach; ?>
  <link rel="alternate stylesheet" href="css/impresion.css" media="screen" title="Vista previa de impresión">
  <!-- Impresión: sin title para que se aplique siempre al imprimir -->
  <link rel="stylesheet" href="css/impresion.css" media="print">
<?php foreach ($estilosExtra as $css): ?>
  <link rel="stylesheet" href="<?= e($css) ?>">
<?php endforeach; ?>
<?php foreach ($scriptsExtra as $js): ?>
  <script src="<?= e($js) ?>" defer></script>
<?php endforeach; ?>
</head>