<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo       = 'Iniciar sesión';
$descripcion  = 'Accede a tu cuenta de PI - Pisos & Inmuebles';
$estilosExtra = ['css/validacion.css'];
// Mensaje de error que control_acceso.php envía por la URL (?error=...)
$erroresAcceso = [
    'vacio'        => 'Debes escribir tu nombre de usuario y tu contraseña (no valen solo espacios ni tabuladores).',
    'credenciales' => 'El nombre de usuario o la contraseña no son correctos.',
];
$mensajeError = $erroresAcceso[textoRecibido($_GET, 'error')] ?? null;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Iniciar sesión</h1>

    <p>Los campos marcados con * son obligatorios.</p>
        <?php if ($mensajeError !== null): ?>
          
    <p class="mensaje-error" role="alert"><?= e($mensajeError) ?></p>
    <?php endif; ?>

    <form id="form-login" action="control_acceso.php" method="post" novalidate>
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
