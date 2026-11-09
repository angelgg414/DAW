<?php
/*
 * Crear anuncio (parte privada): formulario con los datos de un anuncio nuevo.
 * El guardado (base de datos) y la subida de la foto se harán en una práctica posterior.
 */
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Publicar anuncio';
$descripcion = 'Publica un anuncio de venta o alquiler en PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Publicar un anuncio</h1>
    <p>Los campos marcados con * son obligatorios.</p>

    <form action="crearanuncio.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Datos del anuncio</legend>

        <fieldset>
          <legend>Tipo de anuncio *</legend>
          <p>
            <?php foreach (obtenerTiposAnuncio() as $valor => $etiqueta): ?>
            <input type="radio" id="crear-tipo-<?= e($valor) ?>" name="tipo_anuncio" value="<?= e($valor) ?>" required>
            <label for="crear-tipo-<?= e($valor) ?>"><?= e($etiqueta) ?></label>
            <?php endforeach; ?>
          </p>
        </fieldset>

        <p class="campo">
          <label for="crear-vivienda">Tipo de vivienda *</label>
          <select id="crear-vivienda" name="tipo_vivienda" required>
            <option value="">-- Selecciona el tipo --</option>
            <?php foreach (obtenerTiposVivienda() as $valor => $etiqueta): ?>
            <option value="<?= e($valor) ?>"><?= e($etiqueta) ?></option>
            <?php endforeach; ?>
          </select>
        </p>

        <p class="campo">
          <label for="crear-titulo">Título *</label>
          <input type="text" id="crear-titulo" name="titulo" maxlength="200" required>
        </p>

        <p class="campo">
          <label for="crear-precio">Precio (€) *</label>
          <input type="number" id="crear-precio" name="precio" min="0" step="1" required>
        </p>

        <p class="campo">
          <label for="crear-texto">Texto *</label>
          <textarea id="crear-texto" name="texto" rows="6" cols="60" maxlength="4000" required></textarea>
        </p>
      </fieldset>

      <fieldset>
        <legend>Ubicación</legend>
        <p class="campo">
          <label for="crear-ciudad">Ciudad *</label>
          <input type="text" id="crear-ciudad" name="ciudad" maxlength="100" required>
        </p>
        <p class="campo">
          <label for="crear-pais">País *</label>
          <select id="crear-pais" name="pais" required>
            <option value="">-- Selecciona un país --</option>
            <?php foreach (obtenerPaises() as $codigo => $nombre): ?>
            <option value="<?= e($codigo) ?>"><?= e($nombre) ?></option>
            <?php endforeach; ?>
          </select>
        </p>
      </fieldset>

      <fieldset>
        <legend>Características</legend>
        <p class="campo">
          <label for="crear-superficie">Superficie (m²)</label>
          <input type="number" id="crear-superficie" name="superficie" min="1" step="1">
        </p>
        <p class="campo">
          <label for="crear-habitaciones">Número de habitaciones</label>
          <input type="number" id="crear-habitaciones" name="habitaciones" min="0" step="1">
        </p>
        <p class="campo">
          <label for="crear-banos">Número de baños</label>
          <input type="number" id="crear-banos" name="banos" min="0" step="1">
        </p>
        <p class="campo">
          <label for="crear-planta">Planta</label>
          <input type="text" id="crear-planta" name="planta" maxlength="50">
        </p>
        <p class="campo">
          <label for="crear-anio">Año de construcción</label>
          <input type="number" id="crear-anio" name="anio" min="1800" max="2100" step="1">
        </p>
      </fieldset>

      <fieldset>
        <legend>Foto principal</legend>
        <p class="campo">
          <label for="crear-foto">Foto</label>
          <input type="file" id="crear-foto" name="foto" accept="image/png, image/jpeg, image/webp">
        </p>
        <p class="campo">
          <label for="crear-foto-alt">Texto alternativo</label>
          <input type="text" id="crear-foto-alt" name="foto_alt" minlength="10" maxlength="255">
        </p>
      </fieldset>

      <p class="acciones">
        <button type="submit" disabled>Publicar anuncio</button>
      </p>
      <p>La publicación se habilitará en una próxima práctica, cuando haya base de datos.</p>
    </form>

    <p><a href="misanuncios.php">Volver a mis anuncios</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
