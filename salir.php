<?php
/*
 * Salir: olvida al usuario recordado (registro y cookie), borra los últimos anuncios visitados,
 * cierra la sesión y vuelve a la portada.
 */
require_once __DIR__ . '/includes/arranque.php';

olvidarRecordado();
borrarUltimos();
cerrarSesion();
redirigir('index.php');
