<?php
/*
 * Panel "Últimos anuncios visitados". Lo incluye pie.php en las páginas públicas y
 * públicas restringidas (no en las privadas). Se ve también sin haber iniciado sesión.
 */
$idsUltimos = idsUltimos();
?>
  <section class="panel-ultimos" aria-labelledby="titulo-ultimos">
    <h2 id="titulo-ultimos">Últimos anuncios visitados</h2>
<?php if ($idsUltimos): ?>
    <ol>
<?php foreach ($idsUltimos as $idUltimo): ?>
<?php $visitado = obtenerAnuncio($idUltimo); ?>
      <li>
        <a href="anuncio.php?id=<?= $visitado['id'] ?>">
          <img src="<?= e($visitado['foto']['ruta']) ?>" alt="" width="160" height="120">
          <?= e($visitado['titulo']) ?>
        </a>
        <span><?= e($visitado['ciudad']) ?>, <?= e($visitado['pais']) ?></span>
        <span><?= e(formatearPrecio($visitado)) ?></span>
      </li>
<?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>Todavía no has visitado ningún anuncio.</p>
<?php endif; ?>
  </section>

