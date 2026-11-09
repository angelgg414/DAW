<?php
/*
 * Ficha completa de un anuncio, compartida por anuncio.php (parte pública) y veranuncio.php (parte privada).
 * Necesita $anuncio (de obtenerAnuncio()). Se incluye dentro de <article class="detalle">;
 * cada página añade después sus propias acciones.
 */
?>
      <h1><?= e($anuncio['titulo']) ?></h1>

      <dl>
        <dt>Tipo de anuncio</dt>
        <dd><?= e($anuncio['tipo_anuncio']) ?></dd>
        <dt>Tipo de vivienda</dt>
        <dd><?= e($anuncio['tipo_vivienda']) ?></dd>
        <dt>Fecha de publicación</dt>
        <dd><time datetime="<?= e($anuncio['fecha']) ?>"><?= e(formatearFecha($anuncio['fecha'])) ?></time></dd>
        <dt>Ubicación</dt>
        <dd><?= e($anuncio['ciudad']) ?>, <?= e($anuncio['pais']) ?></dd>
        <dt>Precio</dt>
        <dd><data value="<?= e((string) $anuncio['precio']) ?>"><?= e(formatearPrecio($anuncio)) ?></data></dd>
      </dl>

      <figure>
        <img src="<?= e($anuncio['foto']['ruta']) ?>" alt="<?= e($anuncio['foto']['alt']) ?>" width="800" height="600">
        <figcaption>Foto principal</figcaption>
      </figure>

      <section>
        <h2>Descripción</h2>
        <p><?= e($anuncio['texto']) ?></p>
      </section>

      <section>
        <h2>Características</h2>
        <dl>
          <?php foreach (caracteristicasVisibles($anuncio) as $nombre => $valor): ?>
          <dt><?= e($nombre) ?></dt><dd><?= e($valor) ?></dd>
          <?php endforeach; ?>
        </dl>
      </section>

      <section>
        <h2>Más fotos</h2>
        <ul class="galeria">
          <?php foreach ($anuncio['fotos'] as $foto): ?>
          <li>
            <figure>
              <a href="<?= e($foto['ruta']) ?>"><img src="<?= e($foto['ruta']) ?>" alt="<?= e($foto['alt']) ?>" width="320" height="240"></a>
              <figcaption><?= e($foto['titulo']) ?></figcaption>
            </figure>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
