<?php
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

// El anuncio al que se escribe llega por la URL (?id=...); sin un id válido no hay a quién escribir.
$id = idRecibido($_GET, 'id');
if ($id === null) {
    redirigir('404.php');
}
$anuncio = obtenerAnuncio($id);

// Errores que devuelve respuestamensaje.php (?errores=tipo,texto): solo se aceptan los conocidos
$mensajes = [
    'tipo'  => 'Elige un tipo de mensaje válido.',
    'texto' => 'Escribe el texto del mensaje.',
];
$errores    = array_intersect_key($mensajes, array_flip(explode(',', textoRecibido($_GET, 'errores'))));
$errorTipo  = $errores['tipo'] ?? null;
$errorTexto = $errores['texto'] ?? null;

$titulo       = 'Enviar mensaje';
$descripcion  = 'Envía un mensaje al anunciante en PI - Pisos & Inmuebles';
$privada      = true;
$estilosExtra = ['css/validacion.css'];

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Enviar un mensaje al anunciante</h1>

    <p>Anuncio: <a href="anuncio.php?id=<?= $anuncio['id'] ?>"><?= e($anuncio['titulo']) ?></a> (<?= e($anuncio['ciudad']) ?>, <?= e($anuncio['pais']) ?> · <?= e(formatearPrecio($anuncio)) ?>)</p>
    <p>Anunciante: <?= e($anuncio['usuario']) ?></p>

    <?php if ($errores): ?>
    <p class="mensaje-error" role="alert">No se ha podido enviar el mensaje: revisa los campos marcados.</p>
    <?php endif; ?>

    <form action="respuestamensaje.php" method="post" novalidate>
      <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">

      <fieldset<?= $errorTipo ? ' class="campo-con-error" aria-describedby="error-msg-tipo"' : '' ?>>
        <legend>Tipo de mensaje</legend>
        <?php foreach (obtenerTiposMensaje() as $valor => $etiqueta): ?>
        <p>
          <input type="radio" id="msg-tipo-<?= e($valor) ?>" name="tipo_mensaje" value="<?= e($valor) ?>"<?= $valor === 'informacion' ? ' checked' : '' ?>>
          <label for="msg-tipo-<?= e($valor) ?>"><?= e($etiqueta) ?></label>
        </p>
        <?php endforeach; ?>
        <?php if ($errorTipo): ?>
        <p class="mensaje-error" id="error-msg-tipo"><?= e($errorTipo) ?></p>
        <?php endif; ?>
      </fieldset>

      <p class="campo<?= $errorTexto ? ' campo-con-error' : '' ?>">
        <label for="msg-texto">Mensaje</label>
        <textarea id="msg-texto" name="texto" rows="8" cols="60" maxlength="4000"<?= atributosError($errorTexto, 'msg-texto') ?>></textarea>
        <?php if ($errorTexto): ?>
        <span class="mensaje-error" id="error-msg-texto"><?= e($errorTexto) ?></span>
        <?php endif; ?>
      </p>

      <p class="acciones">
        <button type="submit">Enviar mensaje</button>
      </p>
    </form>

    <p><a href="anuncio.php?id=<?= $anuncio['id'] ?>">Volver al anuncio</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
