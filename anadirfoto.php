<?php
/*
 * Añadir foto a un anuncio (parte privada).
 * - Desde el menú (sin ?id): el usuario elige el anuncio; por defecto ninguno seleccionado.
 * - Desde "Mis anuncios" o "Ver anuncio" (?id=N): el anuncio llega seleccionado y no se puede cambiar.
 * La subida de la foto y su página de respuesta se harán en una práctica posterior.
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';

$anuncios = obtenerAnuncios();
$id       = idRecibido($_GET, 'id');       // null si se llega desde el menú
$fijado   = ($id !== null);
$claveSeleccionada = $fijado ? claveAnuncioEjemplo($id) : null;

$titulo      = 'Añadir foto a un anuncio';
$descripcion = 'Añade una foto a uno de tus anuncios en PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Añadir foto a un anuncio</h1>
    <p>Los campos marcados con * son obligatorios.</p>

    <form action="anadirfoto.php" method="post" enctype="multipart/form-data">
      <p class="campo">
        <label for="foto-archivo">Foto *</label>
        <input type="file" id="foto-archivo" name="foto" accept="image/png, image/jpeg, image/webp" required>
      </p>

      <p class="campo">
        <label for="foto-alt">Texto alternativo *</label>
        <input type="text" id="foto-alt" name="alt" minlength="10" maxlength="255" required aria-describedby="ayuda-foto-alt">
      </p>
      <p id="ayuda-foto-alt">Describe lo que se ve en la foto (mínimo 10 caracteres).</p>

      <p class="campo">
        <label for="foto-titulo">Título *</label>
        <input type="text" id="foto-titulo" name="titulo" maxlength="200" required>
      </p>

      <p class="campo">
        <label for="foto-anuncio">Anuncio *</label>
        <?php if ($fijado): ?>
        <?php /* Un select deshabilitado no se envía: el anuncio viaja en el campo oculto */ ?>
        <select id="foto-anuncio" disabled aria-describedby="ayuda-foto-anuncio">
          <?php foreach ($anuncios as $claveOpcion => $anuncio): ?>
          <option<?= $claveOpcion === $claveSeleccionada ? ' selected' : '' ?>><?= e($anuncio['titulo']) ?></option>
          <?php endforeach; ?>
        </select>
        <input type="hidden" name="anuncio" value="<?= $id ?>">
        <?php else: ?>
        <select id="foto-anuncio" name="anuncio" required>
          <option value="" selected>-- Selecciona el anuncio --</option>
          <?php foreach ($anuncios as $anuncio): ?>
          <option value="<?= $anuncio['id'] ?>"><?= e($anuncio['titulo']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php endif; ?>
      </p>
      <?php if ($fijado): ?>
      <p id="ayuda-foto-anuncio">La foto se añadirá a este anuncio; no se puede cambiar.</p>
      <?php endif; ?>

      <p class="acciones">
        <button type="submit" disabled>Añadir foto</button>
      </p>
      <p>La subida de la foto se habilitará en una próxima práctica.</p>
    </form>

    <p><a href="<?= $fijado ? 'veranuncio.php?id=' . $id : 'misanuncios.php' ?>"><?= $fijado ? 'Volver al anuncio' : 'Volver a mis anuncios' ?></a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
