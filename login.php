<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo       = 'Iniciar sesión';
$descripcion  = 'Accede a tu cuenta de PI - Pisos & Inmuebles';
$estilosExtra = ['css/validacion.css'];
$scriptsExtra = ['js/validaciones.js'];

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Iniciar sesión</h1>

    <p>Los campos marcados con * son obligatorios.</p>

    <form id="form-login" action="indexlogueado.php" method="post" novalidate>
      <p class="campo">
        <label for="login-usuario">Nombre de usuario</label>
        <input type="text" id="login-usuario" name="usuario" autocomplete="username">
      </p>
      <p class="campo">
        <label for="login-clave">Contraseña</label>
        <input type="password" id="login-clave" name="clave" autocomplete="current-password">
      </p>
      <p>
        <input type="checkbox" id="login-recordar" name="recordar" value="si">
        <label for="login-recordar">Recordarme en este equipo</label>
      </p>
      <p class="acciones">
        <button type="submit">Entrar</button>
      </p>
    </form>

    <p><a href="404.php">¿Has olvidado tu contraseña?</a></p>
    <p>¿Aún no tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
