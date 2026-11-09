<?php
/*
 * Mis anuncios (parte privada): listado de los anuncios del usuario.
 * Sin sesiones ni base de datos todavía, se listan los anuncios de ejemplo.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

$anuncios = obtenerAnuncios();

$titulo      = 'Mis anuncios';
$descripcion = 'Anuncios publicados en tu cuenta de PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Mis anuncios</h1>
    <p><a href="crearanuncio.php">Publicar un anuncio nuevo</a></p>

    <section class="anuncios">
      <h2>Anuncios publicados (<?= count($anuncios) ?>)</h2>

      <?php foreach ($anuncios as $anuncio): ?>
      <article class="anuncio">
        <h3><a href="veranuncio.php?id=<?= $anuncio['id'] ?>"><?= e($anuncio['titulo']) ?></a></h3>
        <figure>
          <img src="<?= e($anuncio['foto']['ruta']) ?>" alt="<?= e($anuncio['foto']['alt']) ?>" width="320" height="240">
        </figure>
        <p><?= e($anuncio['ciudad']) ?>, <?= e($anuncio['pais']) ?></p>
        <p>Precio: <data value="<?= e((string) $anuncio['precio']) ?>"><?= e(formatearPrecio($anuncio)) ?></data></p>
        <ul>
          <li><a href="veranuncio.php?id=<?= $anuncio['id'] ?>">Ver anuncio</a></li>
          <li><a href="anadirfoto.php?id=<?= $anuncio['id'] ?>">Añadir foto</a></li>
        </ul>
      </article>
      <?php endforeach; ?>
    </section>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
