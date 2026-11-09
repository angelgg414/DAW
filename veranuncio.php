<?php
/*
 * Ver anuncio (parte privada): ficha completa de un anuncio del usuario,
 * con el enlace para añadirle una foto.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

$id = idRecibido($_GET, 'id');
if ($id === null) {
    redirigir('misanuncios.php');
}
$anuncio = obtenerAnuncio($id);

$titulo      = $anuncio['titulo'];
$descripcion = 'Tu anuncio: ' . $anuncio['titulo'];
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <article class="detalle">
<?php require __DIR__ . '/includes/detalle_anuncio.php'; ?>

      <section>
        <h2>Gestionar el anuncio</h2>
        <ul>
          <li><a href="anadirfoto.php?id=<?= $anuncio['id'] ?>">Añadir una foto a este anuncio</a></li>
        </ul>
      </section>
    </article>

    <p><a href="misanuncios.php">Volver a mis anuncios</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
