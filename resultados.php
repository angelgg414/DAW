<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Resultados de la búsqueda';
$descripcion = 'Resultados de la búsqueda de anuncios en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Resultados de la búsqueda</h1>

    <section>
      <h2>Criterios de búsqueda</h2>
      <dl>
        <dt>Tipo de anuncio</dt>
        <dd>Venta</dd>
        <dt>País</dt>
        <dd>España</dd>
      </dl>
      <p><a href="busqueda.php">Modificar la búsqueda</a></p>

      <form action="resultados.php" method="get">
        <p class="campo">
          <label for="nueva-busqueda">Nueva búsqueda rápida</label>
          <input type="search" id="nueva-busqueda" name="q" placeholder="Municipio, barrio o calle">
          <button type="submit">Buscar</button>
        </p>
      </form>
    </section>

    <section class="anuncios">
      <h2>4 anuncios encontrados</h2>

      <article class="anuncio">
        <h3><a href="avisoacceso.php">Ático con terraza en el centro</a></h3>
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
          <li><a href="avisoacceso.php">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="avisoacceso.php">Obra nueva con piscina comunitaria</a></h3>
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
          <li><a href="avisoacceso.php">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="avisoacceso.php">Chalet adosado con jardín</a></h3>
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
          <li><a href="avisoacceso.php">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>

      <article class="anuncio">
        <h3><a href="avisoacceso.php">Piso con vistas al mar en primera línea</a></h3>
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
          <li><a href="avisoacceso.php">Contactar</a></li>
          <li><a href="404.php">Compartir</a></li>
        </ul>
      </article>
    </section>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
