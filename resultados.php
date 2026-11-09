<?php
/*
 * Resultados de una búsqueda: muestra los criterios reales recibidos por GET
 * (búsqueda rápida: q; búsqueda avanzada: el resto de campos) y un listado de ejemplo.
 * Solo se muestran los criterios rellenados y válidos; los valores de las listas se traducen a texto.
 * Todavía no hay base de datos, así que los anuncios no se filtran.
 */
require_once __DIR__ . '/includes/funciones.php';

$criterios = [];

$busquedaRapida = trim(textoRecibido($_GET, 'q'));
if ($busquedaRapida !== '') {
    $criterios['Búsqueda rápida'] = $busquedaRapida;
}

$tipoAnuncio = obtenerTiposAnuncio()[textoRecibido($_GET, 'tipo_anuncio')] ?? null;
if ($tipoAnuncio !== null) {
    $criterios['Tipo de anuncio'] = $tipoAnuncio;
}

$tipoVivienda = obtenerTiposVivienda()[textoRecibido($_GET, 'tipo_vivienda')] ?? null;
if ($tipoVivienda !== null) {
    $criterios['Tipo de vivienda'] = $tipoVivienda;
}

$ciudad = trim(textoRecibido($_GET, 'ciudad'));
if ($ciudad !== '') {
    $criterios['Ciudad'] = $ciudad;
}

$pais = obtenerPaises()[textoRecibido($_GET, 'pais')] ?? null;
if ($pais !== null) {
    $criterios['País'] = $pais;
}

// Rango de precio: "entre X y Y", "desde X" o "hasta Y" según lo que se haya indicado
$precioMin = textoRecibido($_GET, 'precio_min');
$precioMax = textoRecibido($_GET, 'precio_max');
$desde = is_numeric($precioMin) ? formatearEuros((float) $precioMin, 0) : null;
$hasta = is_numeric($precioMax) ? formatearEuros((float) $precioMax, 0) : null;
if ($desde !== null && $hasta !== null) {
    $criterios['Precio'] = "entre $desde y $hasta";
} elseif ($desde !== null) {
    $criterios['Precio'] = "desde $desde";
} elseif ($hasta !== null) {
    $criterios['Precio'] = "hasta $hasta";
}

// Rango de fechas de publicación, con el mismo criterio
$fechaDesde = formatearFecha(textoRecibido($_GET, 'fecha_desde'));
$fechaHasta = formatearFecha(textoRecibido($_GET, 'fecha_hasta'));
if ($fechaDesde !== null && $fechaHasta !== null) {
    $criterios['Fecha de publicación'] = "entre el $fechaDesde y el $fechaHasta";
} elseif ($fechaDesde !== null) {
    $criterios['Fecha de publicación'] = "desde el $fechaDesde";
} elseif ($fechaHasta !== null) {
    $criterios['Fecha de publicación'] = "hasta el $fechaHasta";
}

// "Modificar la búsqueda" devuelve al formulario avanzado con los criterios ya rellenos
$parametrosAvanzada = [];
foreach (['tipo_anuncio', 'tipo_vivienda', 'ciudad', 'pais', 'precio_min', 'precio_max', 'fecha_desde', 'fecha_hasta'] as $campo) {
    $valor = textoRecibido($_GET, $campo);
    if ($valor !== '') {
        $parametrosAvanzada[$campo] = $valor;
    }
}
$enlaceModificar = 'busqueda.php' . ($parametrosAvanzada ? '?' . http_build_query($parametrosAvanzada) : '');

$titulo      = 'Resultados de la búsqueda';
$descripcion = 'Resultados de la búsqueda de anuncios en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Resultados de la búsqueda</h1>

    <section>
      <h2>Criterios de búsqueda</h2>
      <?php if ($criterios): ?>
      <dl>
        <?php foreach ($criterios as $nombre => $valor): ?>
        <dt><?= e($nombre) ?></dt>
        <dd><?= e($valor) ?></dd>
        <?php endforeach; ?>
      </dl>
      <?php else: ?>
      <p>No has indicado ningún criterio de búsqueda.</p>
      <?php endif; ?>
      <p><a href="<?= e($enlaceModificar) ?>">Modificar la búsqueda</a></p>

      <form action="resultados.php" method="get">
        <p class="campo campo-busqueda">
          <label for="nueva-busqueda">Nueva búsqueda rápida</label>
          <input type="search" id="nueva-busqueda" name="q" placeholder="Municipio, barrio o calle" value="<?= e($busquedaRapida) ?>">
          <button type="submit">Buscar</button>
        </p>
      </form>

      <p>Todavía no hay base de datos: los anuncios de abajo son de ejemplo y no se filtran según tus criterios.</p>
    </section>

    <section class="anuncios">
      <h2>Anuncios de ejemplo</h2>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=1">Ático con terraza en el centro</a></h3>
        <figure>
          <img src="img/anuncio1.jpg" alt="Fachada del edificio del ático en Alicante" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-27">27 de septiembre de 2026</time></p>
        <p>Alicante, España</p>
        <p>Precio: <data value="245000">245.000 €</data></p>
        <details>
          <summary>Especificaciones</summary>
          <dl>
            <dt>Superficie</dt><dd>110 m²</dd>
            <dt>Habitaciones</dt><dd>3</dd>
            <dt>Baños</dt><dd>2</dd>
          </dl>
        </details>
        <ul>
          <li><a href="tel:+34965000001">Llamar</a></li>
          <li><a href="mensaje.php?id=1">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=2">Obra nueva con piscina comunitaria</a></h3>
        <figure>
          <img src="img/anuncio6.jpg" alt="Edificio de obra nueva en Elche" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-20">20 de septiembre de 2026</time></p>
        <p>Elche, España</p>
        <p>Precio: <data value="310000">310.000 €</data></p>
        <details>
          <summary>Especificaciones</summary>
          <dl>
            <dt>Superficie</dt><dd>125 m²</dd>
            <dt>Habitaciones</dt><dd>4</dd>
            <dt>Baños</dt><dd>2</dd>
          </dl>
        </details>
        <ul>
          <li><a href="tel:+34966000002">Llamar</a></li>
          <li><a href="mensaje.php?id=2">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=3">Chalet adosado con jardín</a></h3>
        <figure>
          <img src="img/anuncio7.jpg" alt="Chalet adosado con tejado a dos aguas en Murcia" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-18">18 de septiembre de 2026</time></p>
        <p>Murcia, España</p>
        <p>Precio: <data value="285000">285.000 €</data></p>
        <details>
          <summary>Especificaciones</summary>
          <dl>
            <dt>Superficie</dt><dd>160 m²</dd>
            <dt>Habitaciones</dt><dd>4</dd>
            <dt>Baños</dt><dd>3</dd>
          </dl>
        </details>
        <ul>
          <li><a href="tel:+34968000003">Llamar</a></li>
          <li><a href="mensaje.php?id=3">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=4">Piso con vistas al mar en primera línea</a></h3>
        <figure>
          <img src="img/anuncio8.jpg" alt="Edificio de apartamentos en primera línea de playa en Benidorm" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-15">15 de septiembre de 2026</time></p>
        <p>Benidorm, España</p>
        <p>Precio: <data value="199000">199.000 €</data></p>
        <details>
          <summary>Especificaciones</summary>
          <dl>
            <dt>Superficie</dt><dd>75 m²</dd>
            <dt>Habitaciones</dt><dd>2</dd>
            <dt>Baños</dt><dd>1</dd>
          </dl>
        </details>
        <ul>
          <li><a href="tel:+34965000004">Llamar</a></li>
          <li><a href="mensaje.php?id=4">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>
    </section>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
