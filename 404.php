<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo      = 'Página no encontrada (404)';
$descripcion = 'La página solicitada no existe en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1" class="aviso">
    <h1>Error 404: página no encontrada</h1>
    <p>Lo sentimos, la página que buscas no existe o todavía está en construcción.</p>
    <ul>
      <li><a href="index.php">Ir a la página principal</a></li>
      <li><a href="busqueda.php">Buscar anuncios</a></li>
    </ul>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
