<?php
/*
 * Respuesta del envío de un mensaje.
 * Valida con PHP que el tipo de mensaje es uno de los permitidos y que se ha escrito texto.
 * Si hay errores, vuelve al formulario con los códigos de error en la URL.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$id = idRecibido($_POST, 'id');
if ($id === null) {
    redirigir('404.php');
}

$tipos = obtenerTiposMensaje();
$tipo  = textoRecibido($_POST, 'tipo_mensaje');
$texto = trim(textoRecibido($_POST, 'texto'));

$errores = [];
if (!isset($tipos[$tipo])) {
    $errores[] = 'tipo';
}
if ($texto === '') {
    $errores[] = 'texto';
}
if ($errores) {
    redirigir('mensaje.php', ['id' => $id, 'errores' => implode(',', $errores)]);
}

$anuncio = obtenerAnuncio($id);
$ahora   = new DateTimeImmutable();

$titulo      = 'Mensaje enviado';
$descripcion = 'Confirmación del envío de un mensaje al anunciante en PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Mensaje enviado con éxito</h1>
    <p>Tu mensaje se ha enviado correctamente al anunciante.</p>

    <section>
      <h2>Datos del mensaje</h2>
      <dl>
        <dt>Anuncio</dt>
        <dd><a href="anuncio.php?id=<?= $anuncio['id'] ?>"><?= e($anuncio['titulo']) ?></a> (<?= e($anuncio['ciudad']) ?>, <?= e($anuncio['pais']) ?> · <?= e(formatearPrecio($anuncio)) ?>)</dd>

        <dt>Destinatario</dt>
        <dd><?= e($anuncio['usuario']) ?></dd>

        <dt>Tipo de mensaje</dt>
        <dd><?= e($tipos[$tipo]) ?></dd>

        <dt>Texto</dt>
        <dd><?= nl2br(e($texto)) ?></dd>

        <dt>Fecha de envío</dt>
        <dd><time datetime="<?= $ahora->format('Y-m-d\TH:i') ?>"><?= $ahora->format('d/m/Y H:i') ?></time></dd>
      </dl>
    </section>

    <ul>
      <li><a href="mismensajes.php">Ver mis mensajes</a></li>
      <li><a href="anuncio.php?id=<?= $anuncio['id'] ?>">Volver al anuncio</a></li>
      <li><a href="indexlogueado.php">Volver al inicio</a></li>
    </ul>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
