<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Mensaje enviado';
$descripcion = 'Confirmación del envío de un mensaje al anunciante en PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Mensaje enviado con éxito</h1>
    <p>Tu mensaje se ha enviado correctamente al anunciante. Te avisaremos cuando recibas una respuesta.</p>

    <section>
      <h2>Datos del mensaje</h2>
      <dl>
        <dt>Anuncio</dt>
        <dd><a href="anuncio.php">Ático con terraza en el centro</a> (Alicante, España · 245.000 €)</dd>

        <dt>Destinatario</dt>
        <dd>mariagarcia</dd>

        <dt>Tipo de mensaje</dt>
        <dd>Más información</dd>

        <dt>Texto</dt>
        <dd>Hola, ¿el ático incluye plaza de garaje? ¿Cuáles son los gastos de comunidad?</dd>

        <dt>Fecha de envío</dt>
        <dd><time datetime="2026-10-03T18:42">3 de octubre de 2026, 18:42</time></dd>
      </dl>
    </section>

    <ul>
      <li><a href="mismensajes.php">Ver mis mensajes</a></li>
      <li><a href="anuncio.php">Volver al anuncio</a></li>
      <li><a href="indexlogueado.php">Volver al inicio</a></li>
    </ul>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
