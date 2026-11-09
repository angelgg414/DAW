<?php
require_once __DIR__ . '/includes/funciones.php';

// Si se llega desde "Modificar la búsqueda", los criterios anteriores vienen en la URL
$datos = [];
foreach (['tipo_anuncio', 'tipo_vivienda', 'ciudad', 'pais', 'precio_min', 'precio_max', 'fecha_desde', 'fecha_hasta'] as $campo) {
    $datos[$campo] = textoRecibido($_GET, $campo);
}

$titulo      = 'Buscar anuncios';
$descripcion = 'Busca anuncios de venta y alquiler en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Buscar anuncios</h1>
    <p>Rellena solo los criterios que te interesen: se mostrarán los anuncios que cumplan todos los indicados.</p>

    <form action="resultados.php" method="get">

      <fieldset>
        <legend>Tipo de anuncio</legend>
        <p>
          <input type="radio" id="bus-anuncio-todos" name="tipo_anuncio" value=""<?= $datos['tipo_anuncio'] === '' ? ' checked' : '' ?>>
          <label for="bus-anuncio-todos">Indiferente</label>
          <?php foreach (obtenerTiposAnuncio() as $valor => $etiqueta): ?>
          <input type="radio" id="bus-anuncio-<?= e($valor) ?>" name="tipo_anuncio" value="<?= e($valor) ?>"<?= $datos['tipo_anuncio'] === $valor ? ' checked' : '' ?>>
          <label for="bus-anuncio-<?= e($valor) ?>"><?= e($etiqueta) ?></label>
          <?php endforeach; ?>
        </p>
      </fieldset>

      <p class="campo">
        <label for="bus-vivienda">Tipo de vivienda</label>
        <select id="bus-vivienda" name="tipo_vivienda">
          <option value="">Indiferente</option>
          <?php foreach (obtenerTiposVivienda() as $valor => $etiqueta): ?>
          <option value="<?= e($valor) ?>"<?= $datos['tipo_vivienda'] === $valor ? ' selected' : '' ?>><?= e($etiqueta) ?></option>
          <?php endforeach; ?>
        </select>
      </p>

      <fieldset>
        <legend>Ubicación</legend>
        <p class="campo">
          <label for="bus-ciudad">Ciudad</label>
          <input type="text" id="bus-ciudad" name="ciudad" maxlength="100" value="<?= e($datos['ciudad']) ?>">
        </p>
        <p class="campo">
          <label for="bus-pais">País</label>
          <select id="bus-pais" name="pais">
            <option value="">Indiferente</option>
            <?php foreach (obtenerPaises() as $codigo => $nombre): ?>
            <option value="<?= e($codigo) ?>"<?= $datos['pais'] === $codigo ? ' selected' : '' ?>><?= e($nombre) ?></option>
            <?php endforeach; ?>
          </select>
        </p>
      </fieldset>

      <fieldset>
        <legend>Precio (€)</legend>
        <p class="campo">
          <label for="bus-precio-min">Desde</label>
          <input type="number" id="bus-precio-min" name="precio_min" min="0" step="1" value="<?= e($datos['precio_min']) ?>">
        </p>
        <p class="campo">
          <label for="bus-precio-max">Hasta</label>
          <input type="number" id="bus-precio-max" name="precio_max" min="0" step="1" value="<?= e($datos['precio_max']) ?>">
        </p>
      </fieldset>

      <fieldset>
        <legend>Fecha de publicación</legend>
        <p class="campo">
          <label for="bus-fecha-desde">Desde</label>
          <input type="date" id="bus-fecha-desde" name="fecha_desde" value="<?= e($datos['fecha_desde']) ?>">
        </p>
        <p class="campo">
          <label for="bus-fecha-hasta">Hasta</label>
          <input type="date" id="bus-fecha-hasta" name="fecha_hasta" value="<?= e($datos['fecha_hasta']) ?>">
        </p>
      </fieldset>

      <p class="acciones">
        <button type="submit">Buscar</button>
        <button type="reset">Limpiar criterios</button>
      </p>
    </form>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
