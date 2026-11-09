<?php
/*
 * Respuesta de la solicitud de folleto.
 * Valida con PHP los datos necesarios para el cálculo (anuncio, copias, resolución y color) y
 * calcula el coste con las tarifas de includes/folleto.php. Como todavía no hay base de datos,
 * el número de páginas y de fotos son valores ficticios; el resto sale del formulario.
 * Coste final = precio de un folleto × número de copias (como indica el enunciado).
 */
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';
require_once __DIR__ . '/includes/folleto.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('solicitarfolleto.php');
}

// Datos de texto recibidos (se recortan) y datos necesarios para el cálculo
$campos = ['nombre', 'email', 'calle', 'numero', 'piso', 'puerta', 'codigo-postal', 'localidad', 'provincia',
           'pais', 'telefono', 'color-portada', 'copias', 'resolucion', 'anuncio', 'fecha-recepcion',
           'impresion-color', 'impresion-precio'];
$datos = [];
foreach ($campos as $campo) {
    $datos[$campo] = trim(textoRecibido($_POST, $campo));
}
$textoAdicional = trim(textoRecibido($_POST, 'texto-adicional'));

$idAnuncio  = idRecibido($_POST, 'anuncio');
$copias     = filter_var($datos['copias'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 99]]);
$resolucion = filter_var($datos['resolucion'], FILTER_VALIDATE_INT);
$color      = $datos['impresion-color'];

$errores = [];
if ($idAnuncio === null) {
    $errores[] = 'anuncio';
}
if ($copias === false) {
    $errores[] = 'copias';
}
if (!in_array($resolucion, RESOLUCIONES_FOLLETO, true)) {
    $errores[] = 'resolucion';
}
if ($color !== 'si' && $color !== 'no') {
    $errores[] = 'color';
}
if ($errores) {
    // Vuelve al formulario con los datos escritos; el texto adicional no viaja en la URL por su longitud
    redirigir('solicitarfolleto.php', $datos + ['errores' => implode(',', $errores)]);
}

// Cálculo del coste
$anuncio        = obtenerAnuncio($idAnuncio);
$aColor         = ($color === 'si');
$precioUnitario = calcularCosteFolleto(PAGINAS_FICTICIAS, FOTOS_FICTICIAS, $aColor, esAltaResolucion($resolucion));
$costeTotal     = $precioUnitario * $copias;

// Textos para mostrar
$pais      = obtenerPaises()[$datos['pais']] ?? '';
$direccion = implode(', ', array_filter(
    [$datos['calle'], $datos['numero'], $datos['piso'], $datos['puerta'], $datos['codigo-postal'], $datos['localidad'], $datos['provincia'], $pais],
    fn ($parte) => $parte !== ''
));
$colorPortadaValido = preg_match('/^#[0-9a-fA-F]{6}$/', $datos['color-portada']) === 1;
$fechaRecepcion     = formatearFecha($datos['fecha-recepcion']);
$impresionPrecio    = ['si' => 'Con precio', 'no' => 'Sin precio'][$datos['impresion-precio']] ?? 'No indicada';

$titulo      = 'Solicitud registrada';
$descripcion = 'Confirmación de solicitud de folleto publicitario - PI Pisos & Inmuebles';
$privada     = true;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Solicitud de folleto registrada</h1>

    <p>La solicitud de impresión de tu folleto publicitario se ha registrado correctamente.</p>

    <section>
      <h2>Datos de la solicitud</h2>

      <dl>
        <dt>Anuncio</dt>
        <dd><?= e($anuncio['titulo']) ?></dd>

        <dt>Texto adicional</dt>
        <dd><?= $textoAdicional !== '' ? nl2br(e($textoAdicional)) : 'Sin texto adicional' ?></dd>

        <dt>Nombre</dt>
        <dd><?= e($datos['nombre']) ?></dd>

        <dt>Correo electrónico</dt>
        <dd><?= e($datos['email']) ?></dd>

        <dt>Dirección</dt>
        <dd><?= e($direccion) ?></dd>

        <dt>Teléfono</dt>
        <dd><?= $datos['telefono'] !== '' ? e($datos['telefono']) : 'No indicado' ?></dd>

        <dt>Color de la portada</dt>
        <dd>
          <?php if ($colorPortadaValido): ?>
          <input type="color" value="<?= e($datos['color-portada']) ?>" disabled aria-label="Muestra del color de la portada">
          <?php endif; ?>
          <?= e($datos['color-portada']) ?>
        </dd>

        <dt>Número de copias</dt>
        <dd><?= $copias ?></dd>

        <dt>Resolución de las fotos</dt>
        <dd><?= $resolucion ?> DPI</dd>

        <dt>Fecha de recepción</dt>
        <dd><?= $fechaRecepcion !== null ? e($fechaRecepcion) : 'No indicada' ?></dd>

        <dt>Impresión a color</dt>
        <dd><?= $aColor ? 'A todo color' : 'Blanco y negro' ?></dd>

        <dt>Impresión del precio</dt>
        <dd><?= e($impresionPrecio) ?></dd>
      </dl>
    </section>

    <section>
      <h2>Coste del folleto</h2>

      <dl>
        <dt>Número de páginas</dt>
        <dd><?= PAGINAS_FICTICIAS ?> (valor ficticio hasta disponer de base de datos)</dd>

        <dt>Número de fotos</dt>
        <dd><?= FOTOS_FICTICIAS ?> (valor ficticio hasta disponer de base de datos)</dd>

        <dt>Precio de un folleto</dt>
        <dd><?= formatearEuros($precioUnitario) ?></dd>

        <dt>Número de copias</dt>
        <dd><?= $copias ?></dd>

        <dt>Coste total</dt>
        <dd><strong><?= formatearEuros($precioUnitario) ?> × <?= $copias ?> = <?= formatearEuros($costeTotal) ?></strong></dd>
      </dl>
    </section>

    <p><a href="solicitarfolleto.php">Realizar otra solicitud</a></p>
    <p><a href="indexlogueado.php">Volver al inicio</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
