<?php
/*
 * Arranque común de todas las páginas: funciones, usuarios, sesión, "Recordarme" y últimos anuncios.
 * Es lo primero que incluye cada página, antes de cualquier salida.
 */
require_once __DIR__ . '/funciones.php';
require_once __DIR__ . '/usuarios.php';
require_once __DIR__ . '/anuncios.php';
require_once __DIR__ . '/sesion.php';
require_once __DIR__ . '/recordar.php';
require_once __DIR__ . '/ultimos.php';

// Si el usuario marcó "Recordarme" y su sesión ya no existe, entra directamente
entrarConCookie();
