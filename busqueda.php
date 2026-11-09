<?php
require_once __DIR__ . '/includes/funciones.php';

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
          <input type="radio" id="bus-anuncio-todos" name="tipo_anuncio" value="" checked>
          <label for="bus-anuncio-todos">Indiferente</label>
          <input type="radio" id="bus-anuncio-venta" name="tipo_anuncio" value="venta">
          <label for="bus-anuncio-venta">Venta</label>
          <input type="radio" id="bus-anuncio-alquiler" name="tipo_anuncio" value="alquiler">
          <label for="bus-anuncio-alquiler">Alquiler</label>
        </p>
      </fieldset>

      <p class="campo">
        <label for="bus-vivienda">Tipo de vivienda</label>
        <select id="bus-vivienda" name="tipo_vivienda">
          <option value="">Indiferente</option>
          <option value="garaje">Garaje</option>
          <option value="local">Local</option>
          <option value="obra-nueva">Obra nueva</option>
          <option value="oficina">Oficina</option>
          <option value="vivienda">Vivienda</option>
        </select>
      </p>

      <fieldset>
        <legend>Ubicación</legend>
        <p class="campo">
          <label for="bus-ciudad">Ciudad</label>
          <input type="text" id="bus-ciudad" name="ciudad" maxlength="100">
        </p>
        <p class="campo">
          <label for="bus-pais">País</label>
          <select id="bus-pais" name="pais">
            <option value="">Indiferente</option>
            <option value="DE">Alemania</option>
            <option value="AR">Argentina</option>
            <option value="BE">Bélgica</option>
            <option value="CL">Chile</option>
            <option value="CO">Colombia</option>
            <option value="ES">España</option>
            <option value="FR">Francia</option>
            <option value="IT">Italia</option>
            <option value="MX">México</option>
            <option value="NL">Países Bajos</option>
            <option value="PT">Portugal</option>
            <option value="GB">Reino Unido</option>
          </select>
        </p>
      </fieldset>

      <fieldset>
        <legend>Precio (€)</legend>
        <p class="campo"><label for="bus-precio-min">Desde</label>
          <input type="number" id="bus-precio-min" name="precio_min" min="0" step="1"></p>
<p class="campo"><label for="bus-precio-max">Hasta</label>
          <input type="number" id="bus-precio-max" name="precio_max" min="0" step="1"></p>
      </fieldset>

      <fieldset>
        <legend>Fecha de publicación</legend>
        <p class="campo"><label for="bus-fecha-desde">Desde</label>
          <input type="date" id="bus-fecha-desde" name="fecha_desde"></p>
<p class="campo"><label for="bus-fecha-hasta">Hasta</label>
          <input type="date" id="bus-fecha-hasta" name="fecha_hasta"></p>
      </fieldset>

      <p class="acciones">
        <button type="submit">Buscar</button>
        <button type="reset">Limpiar criterios</button>
      </p>
    </form>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
