<?php
require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/anuncios.php';
require_once __DIR__ . '/includes/folleto.php';

// Datos que devuelve respuestasolicitarfolleto.php si hay errores (todos salvo el texto adicional)
$campos = ['nombre', 'email', 'calle', 'numero', 'piso', 'puerta', 'codigo-postal', 'localidad', 'provincia',
           'pais', 'telefono', 'color-portada', 'copias', 'resolucion', 'anuncio', 'fecha-recepcion',
           'impresion-color', 'impresion-precio'];
$datos = [];
foreach ($campos as $campo) {
    $datos[$campo] = textoRecibido($_GET, $campo);
}
// Valores iniciales cuando se abre el formulario por primera vez
$datos['color-portada'] = $datos['color-portada'] !== '' ? $datos['color-portada'] : '#000000';
$datos['copias']        = $datos['copias'] !== '' ? $datos['copias'] : '1';
$datos['resolucion']    = $datos['resolucion'] !== '' ? $datos['resolucion'] : '150';

// Errores que devuelve la respuesta (?errores=copias,resolucion,color,anuncio): solo se aceptan los conocidos
$mensajes = [
    'anuncio'    => 'Selecciona uno de tus anuncios.',
    'copias'     => 'Indica un número de copias entre 1 y 99.',
    'resolucion' => 'Elige una resolución válida.',
    'color'      => 'Indica si la impresión es a color o en blanco y negro.',
];
$errores         = array_intersect_key($mensajes, array_flip(explode(',', textoRecibido($_GET, 'errores'))));
$errorAnuncio    = $errores['anuncio'] ?? null;
$errorCopias     = $errores['copias'] ?? null;
$errorResolucion = $errores['resolucion'] ?? null;
$errorColor      = $errores['color'] ?? null;

$titulo       = 'Solicitar folleto';
$descripcion  = 'Solicitud de folleto publicitario impreso - PI Pisos & Inmuebles';
$privada      = true;
$estilosExtra = ['css/validacion.css'];
$scriptsExtra = ['js/folleto.js'];

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Solicitud de impresión de folleto publicitario</h1>

    <p>
      Mediante esta opción puedes solicitar la impresión y envío de un folleto
      publicitario basado en uno de tus anuncios.
    </p>

    <section>
      <h2>Tarifas</h2>

      <table>
        <caption>Tarifas del folleto publicitario</caption>
        <thead>
          <tr>
            <th scope="col">Concepto</th>
            <th scope="col">Tarifa</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Coste de procesamiento y envío</td>
            <td>10 €</td>
          </tr>
          <tr>
            <td>&lt; 5 páginas</td>
            <td>2 € por pág.</td>
          </tr>
          <tr>
            <td>Entre 5 y 10 páginas</td>
            <td>1.8 € por pág.</td>
          </tr>
          <tr>
            <td>&gt; 10 páginas</td>
            <td>1.6 € por pág.</td>
          </tr>
          <tr>
            <td>Blanco y negro</td>
            <td>0 €</td>
          </tr>
          <tr>
            <td>Color</td>
            <td>0.5 € por foto</td>
          </tr>
          <tr>
            <td>Resolución &lt;= 300 dpi</td>
            <td>0 € por foto</td>
          </tr>
          <tr>
            <td>Resolución &gt; 300 dpi</td>
            <td>0.2 € por foto</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section aria-labelledby="titulo-costes">
      <h2 id="titulo-costes">Posibles costes de un folleto</h2>
      <p>Costes para folletos de 1 a 15 páginas, con tres fotos por página, según el color y la resolución. Los importes se calculan a partir de las tarifas anteriores.</p>

      <h3>Tabla calculada con PHP</h3>
      <div class="tabla-desplazable" role="region" aria-labelledby="titulo-costes" tabindex="0">
        <table class="tabla-costes">
          <caption>Posibles costes del folleto publicitario impreso (calculados en el servidor)</caption>
          <thead>
            <tr>
              <th scope="col" rowspan="2">Número de páginas</th>
              <th scope="col" rowspan="2">Número de fotos</th>
              <th scope="colgroup" colspan="2">Blanco y negro</th>
              <th scope="colgroup" colspan="2">Color</th>
            </tr>
            <tr>
              <th scope="col">150-300 dpi</th>
              <th scope="col">450-900 dpi</th>
              <th scope="col">150-300 dpi</th>
              <th scope="col">450-900 dpi</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($paginas = 1; $paginas <= 15; $paginas++): ?>
            <?php $fotos = $paginas * 3; ?>
            <tr>
              <th scope="row"><?= $paginas ?></th>
              <td><?= $fotos ?></td>
              <?php foreach ([[false, false], [false, true], [true, false], [true, true]] as [$color, $alta]): ?>
              <td><?= formatearEuros(calcularCosteFolleto($paginas, $fotos, $color, $alta)) ?></td>
              <?php endforeach; ?>
            </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>

      <h3>Tabla calculada con JavaScript (para comparar)</h3>
      <p><button type="button" id="alternar-costes" aria-controls="contenedor-costes" aria-expanded="false">Mostrar tabla de costes</button></p>
      <div id="contenedor-costes" class="tabla-desplazable" hidden></div>
    </section>

    <section>
      <h2>Formulario de solicitud</h2>

      <p>
        Rellena el siguiente formulario aportando todos los datos necesarios
        para solicitar tu folleto publicitario.
      </p>

      <p>Los campos marcados con (*) son obligatorios.</p>

      <?php if ($errores): ?>
      <p class="mensaje-error" role="alert">No se ha podido registrar la solicitud: revisa los campos marcados.</p>
      <?php endif; ?>

      <form action="respuestasolicitarfolleto.php" method="post">

        <p class="campo">
          <label for="texto-adicional">Texto adicional:</label>
          <textarea id="texto-adicional" name="texto-adicional" maxlength="4000" rows="5" cols="60"></textarea>
        </p>

        <p class="campo">
          <label for="nombre">Nombre: (*)</label>
          <input type="text" id="nombre" name="nombre" maxlength="200" required value="<?= e($datos['nombre']) ?>">
        </p>

        <p class="campo">
          <label for="email">Correo electrónico: (*)</label>
          <input type="email" id="email" name="email" maxlength="200" required value="<?= e($datos['email']) ?>">
        </p>

        <fieldset>
          <legend>Dirección de envío (*)</legend>

          <p class="campo">
            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle" required value="<?= e($datos['calle']) ?>">
          </p>

          <p class="campo">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required value="<?= e($datos['numero']) ?>">
          </p>

          <p class="campo">
            <label for="piso">Piso:</label>
            <input type="text" id="piso" name="piso" required value="<?= e($datos['piso']) ?>">
          </p>

          <p class="campo">
            <label for="puerta">Puerta:</label>
            <input type="text" id="puerta" name="puerta" required value="<?= e($datos['puerta']) ?>">
          </p>

          <p class="campo">
            <label for="codigo-postal">Código postal:</label>
            <input type="text" id="codigo-postal" name="codigo-postal" required value="<?= e($datos['codigo-postal']) ?>">
          </p>

          <p class="campo">
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" required value="<?= e($datos['localidad']) ?>">
          </p>

          <p class="campo">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" required value="<?= e($datos['provincia']) ?>">
          </p>

          <p class="campo">
            <label for="pais">País</label>
            <select id="pais" name="pais">
              <option value="">-- Selecciona un país --</option>
              <?php foreach (obtenerPaises() as $codigo => $nombre): ?>
              <option value="<?= e($codigo) ?>"<?= $datos['pais'] === $codigo ? ' selected' : '' ?>><?= e($nombre) ?></option>
              <?php endforeach; ?>
            </select>
          </p>
        </fieldset>

        <p class="campo">
          <label for="telefono">Teléfono:</label>
          <input type="tel" id="telefono" name="telefono" value="<?= e($datos['telefono']) ?>">
        </p>

        <p class="campo">
          <label for="color-portada">Color de la portada: (*)</label>
          <input type="color" id="color-portada" name="color-portada" value="<?= e($datos['color-portada']) ?>">
        </p>

        <p class="campo<?= $errorCopias ? ' campo-con-error' : '' ?>">
          <label for="copias">Número de copias: (*)</label>
          <input type="number" id="copias" name="copias" min="1" max="99" value="<?= e($datos['copias']) ?>"<?= atributosError($errorCopias, 'copias') ?>>
          <?php if ($errorCopias): ?>
          <span class="mensaje-error" id="error-copias"><?= e($errorCopias) ?></span>
          <?php endif; ?>
        </p>

        <p class="campo<?= $errorResolucion ? ' campo-con-error' : '' ?>">
          <label for="resolucion">Resolución de las fotos: (*)</label>
          <input type="range" id="resolucion" name="resolucion" min="150" max="900" step="150" value="<?= e($datos['resolucion']) ?>"<?= atributosError($errorResolucion, 'resolucion') ?>>
          <span><output id="valorResolucion"><?= e($datos['resolucion']) ?></output> DPI</span>
          <?php if ($errorResolucion): ?>
          <span class="mensaje-error" id="error-resolucion"><?= e($errorResolucion) ?></span>
          <?php endif; ?>
        </p>

        <p class="campo<?= $errorAnuncio ? ' campo-con-error' : '' ?>">
          <label for="anuncio">Anuncio: (*)</label>
          <select id="anuncio" name="anuncio"<?= atributosError($errorAnuncio, 'anuncio') ?>>
            <option value="">Selecciona uno de tus anuncios</option>
            <?php foreach (obtenerAnuncios() as $anuncio): ?>
            <option value="<?= $anuncio['id'] ?>"<?= $datos['anuncio'] === (string) $anuncio['id'] ? ' selected' : '' ?>><?= e($anuncio['titulo']) ?></option>
            <?php endforeach; ?>
          </select>
          <?php if ($errorAnuncio): ?>
          <span class="mensaje-error" id="error-anuncio"><?= e($errorAnuncio) ?></span>
          <?php endif; ?>
        </p>

        <p class="campo">
          <label for="fecha-recepcion">Fecha de recepción:</label>
          <input type="date" id="fecha-recepcion" name="fecha-recepcion" value="<?= e($datos['fecha-recepcion']) ?>">
        </p>

        <fieldset<?= $errorColor ? ' class="campo-con-error" aria-describedby="error-color"' : '' ?>>
          <legend>Impresión a color: (*)</legend>

          <input type="radio" id="color-si" name="impresion-color" value="si"<?= $datos['impresion-color'] === 'si' ? ' checked' : '' ?>>
          <label for="color-si">A todo color</label>

          <input type="radio" id="color-no" name="impresion-color" value="no"<?= $datos['impresion-color'] === 'no' ? ' checked' : '' ?>>
          <label for="color-no">Blanco y negro</label>

          <?php if ($errorColor): ?>
          <p class="mensaje-error" id="error-color"><?= e($errorColor) ?></p>
          <?php endif; ?>
        </fieldset>

        <fieldset>
          <legend>Impresión del precio: (*)</legend>

          <input type="radio" id="precio-si" name="impresion-precio" value="si" required<?= $datos['impresion-precio'] === 'si' ? ' checked' : '' ?>>
          <label for="precio-si">Con precio</label>

          <input type="radio" id="precio-no" name="impresion-precio" value="no"<?= $datos['impresion-precio'] === 'no' ? ' checked' : '' ?>>
          <label for="precio-no">Sin precio</label>
        </fieldset>

        <p class="acciones">
          <input type="submit" value="Solicitar folleto">
          <input type="reset" value="Restablecer formulario">
        </p>

      </form>
    </section>

  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
