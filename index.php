<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo       = 'Inicio';
$descripcion  = 'PI - Pisos & Inmuebles: anuncios de venta y alquiler de viviendas, oficinas, locales y garajes';


require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">

    <section class="busqueda-rapida">
      <h2>Búsqueda rápida</h2>
      <form action="resultados.php" method="get">
        <p class="campo">
          <label for="busqueda-rapida">Municipio, barrio o calle</label>
          <input type="search" id="busqueda-rapida" name="q" placeholder="Ej.: Alicante, Playa de San Juan">
          <button type="submit">Buscar</button>
        </p>
      </form>
      <p><a href="busqueda.php">Búsqueda avanzada</a></p>
    </section>

    <section class="anuncios">
      <h2>Últimos anuncios</h2>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=1">Ático con terraza en el centro</a></h3>
        <figure>
          <img src="img/anuncio1.jpg" alt="Fachada del edificio del ático en Alicante" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-27">27 de septiembre de 2026</time></p>
        <p>Alicante, España</p>
        <p>Precio: <data value="245000">245.000 €</data></p>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=2">Piso reformado a 200 m de la playa</a></h3>
        <figure>
          <img src="img/anuncio2.jpg" alt="Edificio de apartamentos junto a la playa de San Juan" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-26">26 de septiembre de 2026</time></p>
        <p>San Juan de Alicante, España</p>
        <p>Precio: <data value="950">950 €/mes</data></p>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=3">Oficina diáfana en zona financiera</a></h3>
        <figure>
          <img src="img/anuncio3.jpg" alt="Edificio de oficinas acristalado en Valencia" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-25">25 de septiembre de 2026</time></p>
        <p>Valencia, España</p>
        <p>Precio: <data value="1800">1.800 €/mes</data></p>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=4">Local comercial a pie de calle</a></h3>
        <figure>
          <img src="img/anuncio4.jpg" alt="Local comercial con escaparate en Burdeos" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-24">24 de septiembre de 2026</time></p>
        <p>Burdeos, Francia</p>
        <p>Precio: <data value="180000">180.000 €</data></p>
      </article>

      <article class="anuncio">
        <h3><a href="anuncio.php?id=5">Plaza de garaje en el barrio de Alfama</a></h3>
        <figure>
          <img src="img/anuncio5.jpg" alt="Puerta de acceso al garaje en Lisboa" width="320" height="240">
        </figure>
        <p>Publicado el <time datetime="2026-09-22">22 de septiembre de 2026</time></p>
        <p>Lisboa, Portugal</p>
        <p>Precio: <data value="120">120 €/mes</data></p>
      </article>

    </section>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
