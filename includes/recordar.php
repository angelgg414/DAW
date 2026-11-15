<?php
/*
 * "Recordarme en este equipo".
 * La cookie solo guarda un token aleatorio; el servidor guarda el HASH del token en
 * datos/recordados.json junto al usuario, la caducidad y la última visita.
 * La cookie dura 90 días desde el login y no se renueva al usarla (sin expiración deslizante).
 */

const COOKIE_RECORDAR   = 'recordar';
const DURACION_RECORDAR = 90 * 24 * 60 * 60;   // 90 días en segundos

function rutaRecordados(): string
{
    return __DIR__ . '/../datos/recordados.json';
}

/**
 * Registros guardados: hash del token => ['usuario', 'caduca', 'ultimaVisita'] (marcas de tiempo).
 */
function leerRecordados(): array
{
    $ruta = rutaRecordados();
    if (!is_readable($ruta)) {
        return [];   // todavía no se ha recordado a nadie
    }
    $datos = json_decode((string) file_get_contents($ruta), true);
    return is_array($datos) ? $datos : [];
}

/**
 * Guarda los registros, quitando antes los caducados. LOCK_EX evita escrituras simultáneas.
 */
function guardarRecordados(array $registros): void
{
    $vigentes = array_filter($registros, fn ($r) => $r['caduca'] > time());
    file_put_contents(rutaRecordados(), json_encode($vigentes, JSON_PRETTY_PRINT), LOCK_EX);
}

/**
 * Borra el registro del token de este navegador (si lo hay) y su cookie.
 */
function olvidarRecordado(): void
{
    $token = $_COOKIE[COOKIE_RECORDAR] ?? null;
    if (is_string($token)) {
        $registros = leerRecordados();
        unset($registros[hash('sha256', $token)]);
        guardarRecordados($registros);
    }
    setcookie(COOKIE_RECORDAR, '', opcionesCookie(time() - 3600));
}

/**
 * Recuerda a $usuario en este navegador: un token nuevo en la cookie y su hash en el servidor.
 * Solo se recuerda a un usuario: el anterior (si lo había) se olvida.
 */
function recordarUsuario(string $usuario): void
{
    olvidarRecordado();

    $token  = bin2hex(random_bytes(32));
    $ahora  = time();
    $caduca = $ahora + DURACION_RECORDAR;

    $registros = leerRecordados();
    $registros[hash('sha256', $token)] = ['usuario' => $usuario, 'caduca' => $caduca, 'ultimaVisita' => $ahora];
    guardarRecordados($registros);

    setcookie(COOKIE_RECORDAR, $token, opcionesCookie($caduca));
}

/**
 * Si no hay sesión pero sí cookie de recordar válida, inicia la sesión de ese usuario.
 * Guarda en la sesión la última visita anterior (para mostrarla) y anota la actual.
 * La cookie no se vuelve a enviar: caduca a los 90 días del login.
 */
function entrarConCookie(): void
{
    $token = $_COOKIE[COOKIE_RECORDAR] ?? null;
    if (usuarioActual() !== null || !is_string($token)) {
        return;
    }

    $registros = leerRecordados();
    $clave     = hash('sha256', $token);
    $registro  = $registros[$clave] ?? null;

    if ($registro === null || $registro['caduca'] <= time() || obtenerUsuario($registro['usuario']) === null) {
        olvidarRecordado();   // token desconocido, caducado o de un usuario que ya no existe
        return;
    }

    iniciarSesionUsuario($registro['usuario']);
    $_SESSION['ultimaVisita'] = $registro['ultimaVisita'];

    $registros[$clave]['ultimaVisita'] = time();
    guardarRecordados($registros);
}
