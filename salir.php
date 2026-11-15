<?php
/*
 * Salir: cierra la sesión del usuario y vuelve a la portada.
 * (En próximos pasos también borrará las cookies de "Recordarme" y de últimos anuncios.)
 */
require_once __DIR__ . '/includes/arranque.php';

cerrarSesion();
redirigir('index.php');
