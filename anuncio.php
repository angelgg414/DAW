<?php
/*
 * Detalle de un anuncio (parte pública). Se llega desde la portada o desde los resultados de búsqueda.
 * Hasta que haya base de datos, un id impar muestra el anuncio 1 y uno par el anuncio 2.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

$id = idRecibido($_GET, 'id');
if ($id === null) {
    redirigir('404.php');
}
$anuncio = obtenerAnuncio($id);

$titulo      = $anuncio['titulo'];
$descripcion = $anuncio['titulo'] . ' en ' . $anuncio['ciudad'] . ' (' . $anuncio['tipo_anuncio'] . ')';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <article class="detalle">
<?php require __DIR__ . '/includes/detalle_anuncio.php'; ?>

      <section>
        <h2>¿Te interesa?</h2>
        <p>Anunciante: <strong><?= e($anuncio['usuario']) ?></strong></p>
        <p><a href="mensaje.php?id=<?= $anuncio['id'] ?>">Enviar un mensaje al anunciante</a></p>
      </section>
    </article>

    <p><a href="resultados.php">Volver a los resultados</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
