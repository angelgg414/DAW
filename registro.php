<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo       = 'Registro';
$descripcion  = 'Crea tu cuenta en PI - Pisos & Inmuebles para publicar anuncios';
$estilosExtra = ['css/validacion.css'];

// Datos que devuelve respuestaregistro.php cuando hay errores (nunca incluye contraseñas)
$datos = [];
foreach (['usuario', 'email', 'sexo', 'nacimiento', 'ciudad', 'pais'] as $campo) {
    $datos[$campo] = textoRecibido($_GET, $campo);
}

// Códigos de error recibidos por la URL (?errores=usuario,coinciden): solo se aceptan los conocidos
$mensajes = [
    'usuario'   => 'Escribe un nombre de usuario.',
    'clave'     => 'Escribe una contraseña.',
    'clave2'    => 'Repite la contraseña.',
    'coinciden' => 'Las contraseñas no coinciden.',
];
$codigos = explode(',', textoRecibido($_GET, 'errores'));
$errores = array_intersect_key($mensajes, array_flip($codigos));

$errorUsuario = $errores['usuario'] ?? null;
$errorClave   = $errores['clave'] ?? null;
$errorClave2  = $errores['clave2'] ?? $errores['coinciden'] ?? null;

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Registro de nuevo usuario</h1>
    <p>Los campos marcados con * son obligatorios.</p>

    <?php if ($errores): ?>
    <p class="mensaje-error" role="alert">No se ha podido completar el registro: revisa los campos marcados.</p>
    <?php endif; ?>

    <form id="form-registro" action="respuestaregistro.php" method="post" enctype="multipart/form-data" novalidate>

      <fieldset>
        <legend>Datos de la cuenta</legend>
        <p class="campo<?= $errorUsuario ? ' campo-con-error' : '' ?>">
          <label for="reg-usuario">Nombre de usuario *</label>
          <input type="text" id="reg-usuario" name="usuario" autocomplete="username" value="<?= e($datos['usuario']) ?>"<?= atributosError($errorUsuario, 'reg-usuario') ?>>
          <?php if ($errorUsuario): ?>
          <span class="mensaje-error" id="error-reg-usuario"><?= e($errorUsuario) ?></span>
          <?php endif; ?>
        </p>
        <p>Entre 3 y 15 caracteres: letras sin tildes ni ñ y números. No puede empezar por un número.</p>

        <p class="campo<?= $errorClave ? ' campo-con-error' : '' ?>">
          <label for="reg-clave">Contraseña *</label>
          <input type="password" id="reg-clave" name="clave" autocomplete="new-password"<?= atributosError($errorClave, 'reg-clave') ?>>
          <?php if ($errorClave): ?>
          <span class="mensaje-error" id="error-reg-clave"><?= e($errorClave) ?></span>
          <?php endif; ?>
        </p>
        <p>Entre 6 y 15 caracteres: letras sin tildes ni ñ, números, guion (-) y guion bajo (_). Debe incluir al menos una mayúscula, una minúscula y un número.</p>

        <p class="campo<?= $errorClave2 ? ' campo-con-error' : '' ?>">
          <label for="reg-clave2">Repetir contraseña *</label>
          <input type="password" id="reg-clave2" name="clave2" autocomplete="new-password"<?= atributosError($errorClave2, 'reg-clave2') ?>>
          <?php if ($errorClave2): ?>
          <span class="mensaje-error" id="error-reg-clave2"><?= e($errorClave2) ?></span>
          <?php endif; ?>
        </p>

        <p class="campo">
          <label for="reg-email">Correo electrónico *</label>
          <input type="text" id="reg-email" name="email" autocomplete="email" value="<?= e($datos['email']) ?>">
        </p>
        <p>Ejemplo de correo: usuario.ejemplo@dominio.com.</p>
      </fieldset>

      <fieldset>
        <legend>Datos personales</legend>

        <fieldset>
          <legend>Sexo *</legend>
          <p>
            <?php foreach (obtenerSexos() as $valor => $texto): ?>
            <input type="radio" id="reg-sexo-<?= e($valor) ?>" name="sexo" value="<?= e($valor) ?>"<?= $datos['sexo'] === $valor ? ' checked' : '' ?>>
            <label for="reg-sexo-<?= e($valor) ?>"><?= e($texto) ?></label>
            <?php endforeach; ?>
          </p>
        </fieldset>

        <p class="campo">
          <label for="reg-nacimiento">Fecha de nacimiento *</label>
          <input type="text" id="reg-nacimiento" name="nacimiento" placeholder="DD/MM/AAAA" autocomplete="bday" value="<?= e($datos['nacimiento']) ?>">
        </p>
        <p>Escribe la fecha en formato DD/MM/AAAA. Debes tener al menos 18 años el día del registro.</p>
      </fieldset>

      <fieldset>
        <legend>Residencia</legend>
        <p class="campo">
          <label for="reg-ciudad">Ciudad</label>
          <input type="text" id="reg-ciudad" name="ciudad" maxlength="100" value="<?= e($datos['ciudad']) ?>">
        </p>
        <p class="campo">
          <label for="reg-pais">País</label>
          <select id="reg-pais" name="pais">
            <option value="">-- Selecciona un país --</option>
            <?php foreach (obtenerPaises() as $codigo => $nombre): ?>
            <option value="<?= e($codigo) ?>"<?= $datos['pais'] === $codigo ? ' selected' : '' ?>><?= e($nombre) ?></option>
            <?php endforeach; ?>
          </select>
        </p>
      </fieldset>

      <fieldset>
        <legend>Foto de perfil</legend>
        <p class="campo">
          <label for="reg-foto">Foto</label>
          <input type="file" id="reg-foto" name="foto" accept="image/png, image/jpeg, image/webp">
        </p>
      </fieldset>

      <p class="acciones">
        <button type="submit">Crear cuenta</button>
        <button type="reset">Borrar formulario</button>
      </p>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
