<?php
/*
 * Menú lateral de la parte privada. Lo incluye inicio.php cuando $privada es true.
 * "Mis anuncios" y "Publicar anuncio" apuntan a 404.php hasta que se creen sus páginas (paso 9).
 */
?>
  <aside>
    <h2>Hola, usuario</h2>
    <nav aria-label="Menú de usuario">
      <ul>
        <?= itemMenu('404.php', '&#xe7fd;', 'Mis datos') ?>

        <?= itemMenu('404.php', '&#xe88e;', 'Mis anuncios') ?>

        <?= itemMenu('404.php', '&#xe145;', 'Publicar anuncio') ?>

        <?= itemMenu('mismensajes.php', '&#xe158;', 'Mis mensajes') ?>

        <?= itemMenu('solicitarfolleto.php', '&#xe8ad;', 'Solicitar folleto') ?>

        <?= itemMenu('404.php', '&#xe872;', 'Darme de baja') ?>

        <?= itemMenu('index.php', '&#xe9ba;', 'Cerrar sesión') ?>

      </ul>
    </nav>
  </aside>