<?php
/*
 * Inicio del <body>: enlace de salto, cabecera con el nombre del sitio y navegación principal.
 * La navegación depende de si hay un usuario en la sesión (parte privada integrada).
 * Variable opcional que define la página:
 *   $privada (bool) true si la página pertenece a la parte privada: añade el menú lateral
 */
$privada    = $privada ?? false;
$conSesion  = usuarioActual() !== null;
// En las portadas el nombre del sitio es el título principal (h1); en el resto, el h1 está en el <main>.
$etiquetaSitio = in_array(basename($_SERVER['SCRIPT_NAME']), ['index.php', 'indexlogueado.php'], true) ? 'h1' : 'p';
?>
<body<?= $privada ? ' class="privada"' : '' ?>>
  <a class="saltar-contenido" href="#contenido">Saltar al contenido principal</a>

  <header>
    <<?= $etiquetaSitio ?>><a href="index.php">PI Pisos &amp; Inmuebles</a></<?= $etiquetaSitio ?>>
    <nav aria-label="Navegación principal">
      <ul>
        <?= itemMenu('index.php', '&#xe88a;', 'Inicio') ?>

        <?= itemMenu('busqueda.php', '&#xe8b6;', 'Buscar') ?>

<?php if ($conSesion): ?>
        <?= itemMenu('indexlogueado.php', '&#xe7fd;', 'Mi cuenta') ?>

        <?= itemMenu('salir.php', '&#xe9ba;', 'Salir') ?>

<?php else: ?>
        <?= itemMenu('registro.php', '&#xe7fe;', 'Registrarse') ?>

        <?= itemMenu('login.php', '&#xea77;', 'Iniciar sesión') ?>

<?php endif; ?>
      </ul>
    </nav>
  </header>

<?php
if ($privada) {
    require_once __DIR__ . '/menu_privado.php';
}
