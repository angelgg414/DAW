<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Mis mensajes';
$descripcion = 'Mensajes enviados y recibidos en tu cuenta de PI - Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Mis mensajes</h1>
    <p>Aquí puedes consultar los mensajes que has enviado a otros anunciantes y los que has recibido sobre tus anuncios.</p>

    <section>
      <h2 id="mensajes-enviados">Mensajes enviados</h2>
      <div class="tabla-desplazable" role="region" aria-labelledby="mensajes-enviados" tabindex="0">
      <table class="tabla-mensajes">
        <caption>Mensajes que has enviado a otros usuarios, del más reciente al más antiguo</caption>
        <thead>
        <tr>
          <th scope="col">Tipo de mensaje</th>
          <th scope="col">Texto</th>
          <th scope="col">Fecha</th>
          <th scope="col">Destinatario</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Más información</td>
          <td>Hola, ¿el ático incluye plaza de garaje? ¿Cuáles son los gastos de comunidad?</td>
          <td><time datetime="2026-10-03T18:42">3 de octubre de 2026, 18:42</time></td>
          <td>mariagarcia</td>
        </tr>
        <tr>
          <td>Solicitar una cita</td>
          <td>Me gustaría visitar el chalet este sábado por la mañana, si es posible.</td>
          <td><time datetime="2026-09-30T10:15">30 de septiembre de 2026, 10:15</time></td>
          <td>jlopez</td>
        </tr>
        <tr>
          <td>Comunicar una oferta</td>
          <td>Estaría dispuesto a ofrecer 190.000 € por el piso de Benidorm.</td>
          <td><time datetime="2026-09-28T21:03">28 de septiembre de 2026, 21:03</time></td>
          <td>inmobenidorm</td>
        </tr>
        </tbody>
      </table>
      </div>
    </section>

    <section>
      <h2 id="mensajes-recibidos">Mensajes recibidos</h2>
      <div class="tabla-desplazable" role="region" aria-labelledby="mensajes-recibidos" tabindex="0">
      <table class="tabla-mensajes">
        <caption>Mensajes que otros usuarios te han enviado sobre tus anuncios, del más reciente al más antiguo</caption>
        <thead>
        <tr>
          <th scope="col">Tipo de mensaje</th>
          <th scope="col">Texto</th>
          <th scope="col">Fecha</th>
          <th scope="col">Remitente</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Solicitar una cita</td>
          <td>Buenas tardes, ¿podría ver la oficina el lunes a las 17:00?</td>
          <td><time datetime="2026-10-02T16:20">2 de octubre de 2026, 16:20</time></td>
          <td>carmenruiz</td>
        </tr>
        <tr>
          <td>Más información</td>
          <td>¿El piso de la playa se alquila amueblado? ¿Admiten mascotas?</td>
          <td><time datetime="2026-09-29T12:05">29 de septiembre de 2026, 12:05</time></td>
          <td>pablomartin</td>
        </tr>
        </tbody>
      </table>
      </div>
    </section>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
