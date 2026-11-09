<?php
/*
 * Respuesta del formulario de registro.
 * Valida con PHP: usuario, contraseña y repetir contraseña escritos, y contraseñas iguales.
 * Si hay errores, vuelve al formulario (estrategia 2) pasando por la URL los códigos de error
 * y los datos escritos, salvo las contraseñas, que nunca deben ir en una URL.
 */
require_once __DIR__ . '/includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('registro.php');
}

// Datos recibidos: los textos se recortan; las contraseñas se usan tal cual.
$datos = [
    'usuario'    => trim(textoRecibido($_POST, 'usuario')),
    'email'      => trim(textoRecibido($_POST, 'email')),
    'sexo'       => textoRecibido($_POST, 'sexo'),
    'nacimiento' => trim(textoRecibido($_POST, 'nacimiento')),
    'ciudad'     => trim(textoRecibido($_POST, 'ciudad')),
    'pais'       => textoRecibido($_POST, 'pais'),
];
$clave  = textoRecibido($_POST, 'clave');
$clave2 = textoRecibido($_POST, 'clave2');

// Validación: "vacío" incluye escribir solo espacios o tabuladores.
$errores = [];
if ($datos['usuario'] === '') {
    $errores[] = 'usuario';
}
if (trim($clave) === '') {
    $errores[] = 'clave';
}
if (trim($clave2) === '') {
    $errores[] = 'clave2';
} elseif (trim($clave) !== '' && $clave !== $clave2) {
    $errores[] = 'coinciden';
}

if ($errores) {
    redirigir('registro.php', $datos + ['errores' => implode(',', $errores)]);
}

// Textos visibles para los valores de las listas (si el valor no es válido, no se muestra)
$sexo = obtenerSexos()[$datos['sexo']] ?? '';
$pais = obtenerPaises()[$datos['pais']] ?? '';

$titulo      = 'Registro completado';
$descripcion = 'Confirmación del registro de un nuevo usuario en PI - Pisos & Inmuebles';

require_once __DIR__ . '/includes/cabecera.php';
require_once __DIR__ . '/includes/inicio.php';
?>

  <main id="contenido" tabindex="-1">
    <h1>Registro completado</h1>
    <p>Inserción realizada. Estos son los datos que has introducido:</p>

    <dl>
      <dt>Nombre de usuario</dt>
      <dd><?= e($datos['usuario']) ?></dd>
      <dt>Contraseña</dt>
      <dd>Introducida y repetida correctamente (no se muestra por seguridad)</dd>
      <dt>Correo electrónico</dt>
      <dd><?= $datos['email'] !== '' ? e($datos['email']) : 'No indicado' ?></dd>
      <dt>Sexo</dt>
      <dd><?= $sexo !== '' ? e($sexo) : 'No indicado' ?></dd>
      <dt>Fecha de nacimiento</dt>
      <dd><?= $datos['nacimiento'] !== '' ? e($datos['nacimiento']) : 'No indicada' ?></dd>
      <dt>Ciudad</dt>
      <dd><?= $datos['ciudad'] !== '' ? e($datos['ciudad']) : 'No indicada' ?></dd>
      <dt>País</dt>
      <dd><?= $pais !== '' ? e($pais) : 'No indicado' ?></dd>
    </dl>

    <p><a href="login.php">Iniciar sesión</a></p>
  </main>

<?php require_once __DIR__ . '/includes/pie.php'; ?>
