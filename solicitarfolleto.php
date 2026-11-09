<?php
require_once __DIR__ . '/includes/funciones.php';

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

    <p>
      Los campos marcados con un asterisco (*) son obligatorios.
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
      <p>Consulta los costes para folletos de 1 a 15 páginas, con tres fotos por página, según el color y la resolución. Los importes se calculan a partir de las tarifas anteriores.</p>
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

      <form action="respuestasolicitarfolleto.php" method="get">

        <p class="campo">
          <label for="texto-adicional">Texto adicional:</label>
          <textarea id="texto-adicional" name="texto-adicional" maxlength="4000" rows="5" cols="60"></textarea>
        </p>

        <p class="campo">
          <label for="nombre">Nombre: (*)</label>
          <input type="text" id="nombre" name="nombre" maxlength="200" required>
        </p>

        <p class="campo">
          <label for="email">Correo electrónico: (*)</label>
          <input type="email" id="email" name="email" maxlength="200" required>
        </p>

        <fieldset>
          <legend>Dirección de envío (*)</legend>

          <p class="campo">
            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle" required>
          </p>

          <p class="campo">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required>
          </p>

          <p class="campo">
            <label for="piso">Piso:</label>
            <input type="text" id="piso" name="piso" required>
          </p>

          <p class="campo">
            <label for="puerta">Puerta:</label>
            <input type="text" id="puerta" name="puerta" required>
          </p>

          <p class="campo">
            <label for="codigo-postal">Código postal:</label>
            <input type="text" id="codigo-postal" name="codigo-postal" required>
          </p>

          <p class="campo">
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" required>
          </p>

          <p class="campo">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" required>
          </p>

          <p class="campo">
            <label for="pais">País</label>
            <select id="pais" name="pais">
              <option value="">-- Selecciona un país --</option>
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

        <p class="campo">
          <label for="telefono">Teléfono:</label>
          <input type="tel" id="telefono" name="telefono">
        </p>

        <p class="campo">
          <label for="color-portada">Color de la portada: (*)</label>
          <input type="color" id="color-portada" name="color-portada" value="#000000">
        </p>

        <p class="campo">
          <label for="copias">Número de copias: (*)</label>
          <input type="number" id="copias" name="copias" min="1" max="99" value="1" required>
        </p>

        <p class="campo">
          <label for="resolucion">Resolución de las fotos: (*)</label>
          <input type="range" id="resolucion" name="resolucion" min="150" max="900" step="150" value="150">
          <span><output id="valorResolucion">150</output> DPI</span>
        </p>

        <p class="campo">
          <label for="anuncio">Anuncio: (*)</label>
          <select id="anuncio" name="anuncio" required>
            <option value="">Selecciona uno de tus anuncios</option>
            <option value="atico">Ático con terraza en el centro</option>
            <option value="piso-playa">Piso reformado a 200 m de la playa</option>
            <option value="oficina">Oficina diáfana en zona financiera</option>
          </select>
        </p>

        <p class="campo">
          <label for="fecha-recepcion">Fecha de recepción:</label>
          <input type="date" id="fecha-recepcion" name="fecha-recepcion">
        </p>

        <fieldset>
          <legend>Impresión a color: (*)</legend>

          <input type="radio" id="color-si" name="impresion-color" value="si" required>
          <label for="color-si">A todo color</label>

          <input type="radio" id="color-no" name="impresion-color" value="no">
          <label for="color-no">Blanco y negro</label>
        </fieldset>

        <fieldset>
          <legend>Impresión del precio: (*)</legend>

          <input type="radio" id="precio-si" name="impresion-precio" value="si" required>
          <label for="precio-si">Con precio</label>

          <input type="radio" id="precio-no" name="impresion-precio" value="no">
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
