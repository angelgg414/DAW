<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Ático con terraza en el centro';
$descripcion = 'Ático con terraza en el centro de Alicante, en venta';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <article class="detalle">
      <h1>Ático con terraza en el centro</h1>

      <dl>
        <dt>Tipo de anuncio</dt>
        <dd>Venta</dd>
        <dt>Tipo de vivienda</dt>
        <dd>Vivienda</dd>
        <dt>Fecha de publicación</dt>
        <dd><time datetime="2026-09-27">27 de septiembre de 2026</time></dd>
        <dt>Ubicación</dt>
        <dd>Alicante, España</dd>
        <dt>Precio</dt>
        <dd><data value="245000">245.000 €</data></dd>
      </dl>

      <figure>
        <img src="img/anuncio1.jpg" alt="Fachada del edificio del ático en Alicante" width="800" height="600">
        <figcaption>Foto principal: fachada del edificio</figcaption>
      </figure>

      <section>
        <h2>Descripción</h2>
        <p>Luminoso ático de 110 m² situado en pleno centro de Alicante, a cinco minutos a pie de la Explanada y del Mercado Central. La vivienda se distribuye en un amplio salón-comedor con salida a terraza, cocina independiente totalmente equipada, tres dormitorios y dos baños completos.</p>
        <p>La terraza de 40 m² ofrece vistas despejadas al castillo de Santa Bárbara. El edificio cuenta con ascensor y conserjería. Ideal como vivienda habitual o como inversión.</p>
      </section>

      <section>
        <h2>Características</h2>
        <dl>
          <dt>Planta</dt><dd>7.ª (ático)</dd>
          <dt>Ascensor</dt><dd>Sí</dd>
          <dt>Superficie</dt><dd>110 m²</dd>
          <dt>Habitaciones</dt><dd>3</dd>
          <dt>Baños</dt><dd>2</dd>
          <dt>Balcón</dt><dd>No</dd>
          <dt>Terraza</dt><dd>Sí (40 m²)</dd>
          <dt>Año de construcción</dt><dd>1998</dd>
        </dl>
      </section>

      <section>
        <h2>Más fotos</h2>
        <ul class="galeria">
          <li>
            <figure>
              <a href="img/anuncio1salon.jpg"><img src="img/anuncio1salon.jpg" alt="Salón-comedor con ventanal" width="320" height="240"></a>
              <figcaption>Salón-comedor</figcaption>
            </figure>
          </li>
          <li>
            <figure>
              <a href="img/anuncio1cocina.jpg"><img src="img/anuncio1cocina.jpg" alt="Cocina equipada" width="320" height="240"></a>
              <figcaption>Cocina</figcaption>
            </figure>
          </li>
          <li>
            <figure>
              <a href="img/anuncio1terraza.jpg"><img src="img/anuncio1terraza.jpg" alt="Terraza con vistas" width="320" height="240"></a>
              <figcaption>Terraza</figcaption>
            </figure>
          </li>
        </ul>
      </section>

      <section>
        <h2>¿Te interesa?</h2>
        <p>Anunciante: <a href="404.php">mariagarcia</a></p>
        <ul>
          <li><a href="mensaje.php">Enviar un mensaje al anunciante</a></li>
          <li><a href="tel:+34965000001">Llamar al anunciante</a></li>
        </ul>
      </section>
    </article>

    <p><a href="resultados.php">Volver a los resultados</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
