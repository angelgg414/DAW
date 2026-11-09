<?php
/*
 * Menú lateral de la parte privada. Lo incluye inicio.php cuando $privada es true.
 */
?>
  <aside>
    <h2>Hola, usuario</h2>
    <nav aria-label="Menú de usuario">
      <ul>
        <?= itemMenu('404.php', '&#xe7fd;', 'Mis datos') ?>

        <?= itemMenu('misanuncios.php', '&#xe88e;', 'Mis anuncios') ?>

        <?= itemMenu('crearanuncio.php', '&#xe145;', 'Publicar anuncio') ?>

        <?= itemMenu('anadirfoto.php', '&#xe43e;', 'Añadir foto') ?>

        <?= itemMenu('mismensajes.php', '&#xe158;', 'Mis mensajes') ?>

        <?= itemMenu('solicitarfolleto.php', '&#xe8ad;', 'Solicitar folleto') ?>

        <?= itemMenu('404.php', '&#xe872;', 'Darme de baja') ?>

        <?= itemMenu('index.php', '&#xe9ba;', 'Cerrar sesión') ?>

      </ul>
    </nav>
  </aside>
