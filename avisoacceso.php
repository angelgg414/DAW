<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Acceso restringido';
$descripcion = 'Acceso restringido a usuarios registrados en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1" class="aviso">
    <h1>Acceso restringido</h1>
    <p>No puedes ver el detalle de este anuncio porque no has iniciado sesión.</p>
    <p>Para consultar toda la información de los anuncios, sus fotos y contactar con los anunciantes necesitas una cuenta de usuario.</p>
    <ul>
      <li><a href="login.php">Iniciar sesión</a> si ya tienes cuenta.</li>
      <li><a href="registro.php">Regístrate gratis</a> si aún no la tienes.</li>
      <li><a href="index.php">Volver a la página principal</a></li>
    </ul>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
