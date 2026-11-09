<?php
/*
 * Inicio del <body>: enlace de salto, cabecera con el nombre del sitio y navegación principal.
 * Variable opcional que define la página:
 *   $privada (bool) true si la página pertenece a la parte privada (usuario registrado)
 */
$privada = $privada ?? false;
$portada = $privada ? 'indexlogueado.php' : 'index.php';
$etiquetaSitio = (basename($_SERVER['SCRIPT_NAME']) === $portada) ? 'h1' : 'p';
?>
<body<?= $privada ? ' class="privada"' : '' ?>>
  <a class="saltar-contenido" href="#contenido">Saltar al contenido principal</a>

  <header>
           <<?= $etiquetaSitio ?>><a href="<?= $portada ?>">PI Pisos &amp; Inmuebles</a></<?= $etiquetaSitio ?>>
    <nav aria-label="Navegación principal">
      <ul>
        <?= itemMenu($portada, '&#xe88a;', 'Inicio') ?>

        <?= itemMenu('busqueda.php', '&#xe8b6;', 'Buscar') ?>

<?php if (!$privada): ?>
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