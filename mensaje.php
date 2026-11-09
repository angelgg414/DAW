<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Enviar mensaje';
$descripcion = 'Envía un mensaje al anunciante en PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Enviar un mensaje al anunciante</h1>

    <p>Anuncio: <a href="anuncio.php">Ático con terraza en el centro</a> (Alicante, España · 245.000 €)</p>
    <p>Anunciante: mariagarcia</p>

    <form action="respuestamensaje.php" method="get">
      <fieldset>
        <legend>Tipo de mensaje</legend>
        <p>
          <input type="radio" id="msg-tipo-oferta" name="tipo_mensaje" value="oferta">
          <label for="msg-tipo-oferta">Comunicar una oferta</label>
        </p>
        <p>
          <input type="radio" id="msg-tipo-info" name="tipo_mensaje" value="informacion" checked>
          <label for="msg-tipo-info">Más información</label>
        </p>
        <p>
          <input type="radio" id="msg-tipo-cita" name="tipo_mensaje" value="cita">
          <label for="msg-tipo-cita">Solicitar una cita</label>
        </p>
      </fieldset>

      <p class="campo">
        <label for="msg-texto">Mensaje</label>
        <textarea id="msg-texto" name="texto" rows="8" cols="60" maxlength="4000" required></textarea>
      </p>

      <p class="acciones">
        <button type="submit">Enviar mensaje</button>
      </p>
    </form>

    <p><a href="anuncio.php">Volver al anuncio</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
