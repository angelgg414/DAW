<?php
require_once __DIR__ . '/includes/funciones.php';

$titulo       = 'Registro';
$descripcion  = 'Crea tu cuenta en PI - Pisos & Inmuebles para publicar anuncios';
$estilosExtra = ['css/validacion.css'];
$scriptsExtra = ['js/validaciones.js'];

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Registro de nuevo usuario</h1>
    <p>Los campos marcados con * son obligatorios.</p>

    <form id="form-registro" action="indexlogueado.php" method="post" enctype="multipart/form-data" novalidate>

      <fieldset>
        <legend>Datos de la cuenta</legend>
        <p class="campo">
          <label for="reg-usuario">Nombre de usuario *</label>
          <input type="text" id="reg-usuario" name="usuario" autocomplete="username">
        </p>
        <p>Entre 3 y 15 caracteres: letras sin tildes ni ñ y números. No puede empezar por un número.</p>

        <p class="campo">
          <label for="reg-clave">Contraseña *</label>
          <input type="password" id="reg-clave" name="clave" autocomplete="new-password">
        </p>
        <p>Entre 6 y 15 caracteres: letras sin tildes ni ñ, números, guion (-) y guion bajo (_). Debe incluir al menos una mayúscula, una minúscula y un número.</p>

        <p class="campo">
          <label for="reg-clave2">Repetir contraseña *</label>
          <input type="password" id="reg-clave2" name="clave2" autocomplete="new-password">
        </p>

        <p class="campo">
          <label for="reg-email">Correo electrónico *</label>
          <input type="text" id="reg-email" name="email" autocomplete="email">
        </p>
        <p>Ejemplo de correo: usuario.ejemplo@dominio.com.</p>
      </fieldset>

      <fieldset>
        <legend>Datos personales</legend>

        <fieldset>
          <legend>Sexo *</legend>
          <p>
            <input type="radio" id="reg-sexo-mujer" name="sexo" value="mujer">
            <label for="reg-sexo-mujer">Mujer</label>
            <input type="radio" id="reg-sexo-hombre" name="sexo" value="hombre">
            <label for="reg-sexo-hombre">Hombre</label>
            <input type="radio" id="reg-sexo-otro" name="sexo" value="otro">
            <label for="reg-sexo-otro">Otro</label>
          </p>
        </fieldset>

        <p class="campo">
          <label for="reg-nacimiento">Fecha de nacimiento *</label>
          <input type="text" id="reg-nacimiento" name="nacimiento" placeholder="DD/MM/AAAA" autocomplete="bday">
        </p>
        <p>Escribe la fecha en formato DD/MM/AAAA. Debes tener al menos 18 años el día del registro.</p>
      </fieldset>

      <fieldset>
        <legend>Residencia</legend>
        <p class="campo">
          <label for="reg-ciudad">Ciudad</label>
          <input type="text" id="reg-ciudad" name="ciudad" maxlength="100">
        </p>
        <p class="campo">
          <label for="reg-pais">País</label>
          <select id="reg-pais" name="pais">
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
