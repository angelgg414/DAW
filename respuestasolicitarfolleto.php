<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Solicitud registrada';
$descripcion = 'Confirmación de solicitud de folleto publicitario - PI Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Solicitud de folleto registrada</h1>

    <p>
      La solicitud de impresión de tu folleto publicitario
      se ha registrado correctamente.
    </p>

    <section>
      <h2>Datos de la solicitud</h2>

      <dl>
        <dt>Texto adicional</dt>
        <dd>Vivienda reformada recientemente y situada cerca del centro.</dd>

        <dt>Nombre</dt>
        <dd>Diego Patiño</dd>

        <dt>Correo electrónico</dt>
        <dd>diego@gmail.com</dd>

        <dt>Dirección</dt>
        <dd>
          Calle Mayor, 15, 2.º A, 03001 Alicante,
          Alicante, España
        </dd>

        <dt>Teléfono</dt>
        <dd>600 123 456</dd>

        <dt>Color de la portada</dt>
        <dd>
          <input type="color" value="#000000" disabled>
          #000000
        </dd>

        <dt>Número de copias</dt>
        <dd>1</dd>

        <dt>Resolución de las fotos</dt>
        <dd>150 DPI</dd>

        <dt>Anuncio</dt>
        <dd>Ático con terraza en el centro</dd>

        <dt>Fecha de recepción</dt>
        <dd>20/10/2026</dd>

        <dt>Impresión a color</dt>
        <dd>A todo color</dd>

        <dt>Impresión del precio</dt>
        <dd>Con precio</dd>
      </dl>
    </section>

    <section>
      <h2>Coste del folleto</h2>

      <p>
        <strong>Coste total: 25,00 €</strong>
      </p>

      <p>
        El coste mostrado es orientativo y fijo en esta versión de la aplicación.
      </p>
    </section>

    <p>
      <a href="solicitarfolleto.php">Realizar otra solicitud</a>
    </p>

    <p>
      <a href="indexlogueado.php">Volver al inicio</a>
    </p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
