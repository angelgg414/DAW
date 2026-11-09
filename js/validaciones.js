"use strict";

// Práctica 6: comprobaciones programadas a mano, sin expresiones regulares.
function esLetraMayuscula(caracter) {
  const codigo = caracter.charCodeAt(0);
  return codigo >= 65 && codigo <= 90;
}

function esLetraMinuscula(caracter) {
  const codigo = caracter.charCodeAt(0);
  return codigo >= 97 && codigo <= 122;
}

function esNumero(caracter) {
  const codigo = caracter.charCodeAt(0);
  return codigo >= 48 && codigo <= 57;
}

function esLetraInglesa(caracter) {
  return esLetraMayuscula(caracter) || esLetraMinuscula(caracter);
}

function esAlfanumerico(caracter) {
  return esLetraInglesa(caracter) || esNumero(caracter);
}

function validarNoVacio(valor, nombreCampo) {
  if (valor.length === 0) {
    return `Introduce ${nombreCampo}.`;
  }
  if (valor.trim().length === 0) {
    return `No puedes escribir únicamente espacios o tabulaciones en ${nombreCampo}.`;
  }
  return "";
}

function validarUsuario(valor) {
  if (valor.length < 3 || valor.length > 15) {
    return "El usuario debe tener entre 3 y 15 caracteres.";
  }
  if (!esLetraInglesa(valor.charAt(0))) {
    return "El usuario debe empezar por una letra inglesa (A-Z o a-z).";
  }
  for (const caracter of valor) {
    if (!esAlfanumerico(caracter)) {
      return "El usuario solo puede contener letras inglesas y números (sin espacios, tildes ni ñ).";
    }
  }
  return "";
}

function validarContrasena(valor) {
  if (valor.length < 6 || valor.length > 15) {
    return "La contraseña debe tener entre 6 y 15 caracteres.";
  }
  let mayuscula = false;
  let minuscula = false;
  let numero = false;
  for (const caracter of valor) {
    if (esLetraMayuscula(caracter)) {
      mayuscula = true;
    } else if (esLetraMinuscula(caracter)) {
      minuscula = true;
    } else if (esNumero(caracter)) {
      numero = true;
    } else if (caracter !== "-" && caracter !== "_") {
      return "La contraseña solo admite letras inglesas, números, guion (-) y guion bajo (_).";
    }
  }
  if (!mayuscula || !minuscula || !numero) {
    return "La contraseña debe incluir al menos una mayúscula, una minúscula y un número.";
  }
  return "";
}

function validarRepeticion(valor, contrasena) {
  if (valor.length === 0) return "Repite la contraseña.";
  return valor === contrasena ? "" : "Las dos contraseñas deben coincidir.";
}

function validarCorreo(valor) {
  if (valor.length === 0) return "Introduce tu dirección de correo electrónico.";
  if (valor.length > 254) return "El correo electrónico no puede superar los 254 caracteres.";

  const partes = valor.split("@");
  if (partes.length !== 2) return "El correo debe contener una sola @ entre la parte local y el dominio.";
  const local = partes[0];
  const dominio = partes[1];
  if (local.length < 1 || local.length > 64) {
    return "La parte anterior a @ debe tener entre 1 y 64 caracteres.";
  }
  if (dominio.length < 1 || dominio.length > 255) {
    return "El dominio debe tener entre 1 y 255 caracteres.";
  }
  if (local.startsWith(".") || local.endsWith(".") || local.includes("..")) {
    return "La parte anterior a @ no puede comenzar ni terminar con punto, ni contener dos puntos seguidos.";
  }

  const especiales = "!#$%&'*+-/=?^_`{|}~";
  for (const caracter of local) {
    if (!esAlfanumerico(caracter) && caracter !== "." && !especiales.includes(caracter)) {
      return "La parte anterior a @ contiene un carácter no permitido.";
    }
  }

  const subdominios = dominio.split(".");
  for (const subdominio of subdominios) {
    if (subdominio.length < 1 || subdominio.length > 63) {
      return "Cada subdominio debe tener entre 1 y 63 caracteres.";
    }
    if (subdominio.startsWith("-") || subdominio.endsWith("-")) {
      return "Un subdominio no puede comenzar ni terminar con guion.";
    }
    for (const caracter of subdominio) {
      if (!esAlfanumerico(caracter) && caracter !== "-") {
        return "El dominio solo admite letras inglesas, números, guiones interiores y puntos separadores.";
      }
    }
  }
  return "";
}

function todosDigitos(texto) {
  if (texto.length === 0) return false;
  for (const caracter of texto) {
    if (!esNumero(caracter)) return false;
  }
  return true;
}

function validarNacimiento(valor) {
  if (valor.trim().length === 0) return "Introduce tu fecha de nacimiento (DD/MM/AAAA).";
  const partes = valor.split("/");
  if (partes.length !== 3 || partes[0].length !== 2 || partes[1].length !== 2 || partes[2].length !== 4 ||
      !partes.every(todosDigitos)) {
    return "Escribe una fecha con el formato DD/MM/AAAA (por ejemplo, 25/10/2000).";
  }
  const dia = Number(partes[0]);
  const mes = Number(partes[1]);
  const anio = Number(partes[2]);
  if (anio < 1 || mes < 1 || mes > 12 || dia < 1 || dia > 31) {
    return "La fecha de nacimiento no es una fecha válida.";
  }

  // setFullYear evita que los años 0-99 se interpreten automáticamente como 1900-1999.
  const fecha = new Date(0);
  fecha.setFullYear(anio, mes - 1, dia);
  fecha.setHours(12, 0, 0, 0);
  if (fecha.getFullYear() !== anio || fecha.getMonth() !== mes - 1 || fecha.getDate() !== dia) {
    return "La fecha de nacimiento no existe en el calendario.";
  }

  const hoy = new Date();
  const edad = hoy.getFullYear() - anio;
  const cumpleEsteAnio = hoy.getMonth() > mes - 1 ||
    (hoy.getMonth() === mes - 1 && hoy.getDate() >= dia);
  if (edad < 18 || (edad === 18 && !cumpleEsteAnio)) {
    return "Debes tener al menos 18 años cumplidos el día del registro.";
  }
  return "";
}

// Se crea un único aviso por control. Se actualiza sin usar innerHTML.
function prepararAviso(campo) {
  const contenedor = campo.type === "radio" ? campo.closest("fieldset") : campo.closest(".campo");
  if (!contenedor) return;
  const mensaje = document.createElement(campo.type === "radio" ? "p" : "span");
  mensaje.id = `error-${campo.id}`;
  mensaje.className = "mensaje-error";
  mensaje.setAttribute("role", "alert");
  mensaje.hidden = true;
  contenedor.appendChild(mensaje);
  if (campo.type === "radio") {
    for (const opcion of contenedor.querySelectorAll('input[type="radio"]')) {
      opcion.setAttribute("aria-describedby", mensaje.id);
    }
  } else {
    campo.setAttribute("aria-describedby", mensaje.id);
  }
}

function mostrarError(id, error) {
  const campo = document.getElementById(id);
  const mensaje = document.getElementById(`error-${id}`);
  const contenedor = campo.type === "radio" ? campo.closest("fieldset") : campo.closest(".campo");
  mensaje.textContent = error;
  mensaje.hidden = error === "";
  contenedor.classList.toggle("campo-con-error", error !== "");
  if (campo.type === "radio") {
    for (const opcion of contenedor.querySelectorAll('input[type="radio"]')) {
      opcion.setAttribute("aria-invalid", String(error !== ""));
    }
  } else {
    campo.setAttribute("aria-invalid", String(error !== ""));
  }
}

function configurarFormulario(formulario, validadores, destino) {
  if (!formulario) return;
  const ids = Object.keys(validadores);
  let intentadoEnviar = false;
  const visitados = new Set();
  let pulsandoEnvio = false;

  // Evita que el mensaje de blur desplace el botón entre pulsarlo y soltarlo.
  formulario.addEventListener("pointerdown", (evento) => {
    pulsandoEnvio = Boolean(evento.target.closest('button[type="submit"], input[type="submit"]'));
  });
  document.addEventListener("pointerup", () => { pulsandoEnvio = false; });
  document.addEventListener("pointercancel", () => { pulsandoEnvio = false; });

  for (const id of ids) {
    const campo = document.getElementById(id);
    prepararAviso(campo);
    const evento = campo.type === "radio" ? "change" : "input";
    campo.addEventListener("blur", (evento) => {
      visitados.add(id);
      // Al pulsar "Entrar", la validación completa del submit mostrará TODOS
      // los errores. Mostrar solo este ahora movería el botón bajo el ratón.
      const siguiente = evento.relatedTarget;
      if (pulsandoEnvio || (siguiente && siguiente.form === formulario && siguiente.type === "submit")) {
        return;
      }
      mostrarError(id, validadores[id]());
    });
    const controles = campo.type === "radio"
      ? campo.closest("fieldset").querySelectorAll('input[type="radio"]')
      : [campo];
    for (const control of controles) {
      control.addEventListener(evento, () => {
        if (intentadoEnviar || visitados.has(id)) mostrarError(id, validadores[id]());
      });
    }
  }

  formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();
    intentadoEnviar = true;
    let primerError = null;
    for (const id of ids) {
      const error = validadores[id]();
      mostrarError(id, error);
      if (error && !primerError) primerError = document.getElementById(id);
    }
    if (primerError) {
      primerError.focus();
      return;
    }
    // Sitio estático: simula el destino, sin transmitir contraseñas por GET.
    window.location.assign(destino);
  });

  formulario.addEventListener("reset", () => {
    intentadoEnviar = false;
    visitados.clear();
    for (const id of ids) mostrarError(id, "");
  });
}

document.addEventListener("DOMContentLoaded", () => {
  configurarFormulario(document.getElementById("form-login-inicio"), {
    "inicio-usuario": () => validarNoVacio(document.getElementById("inicio-usuario").value, "tu nombre de usuario"),
    "inicio-clave": () => validarNoVacio(document.getElementById("inicio-clave").value, "tu contraseña")
  }, "indexlogueado.html");

  configurarFormulario(document.getElementById("form-login"), {
    "login-usuario": () => validarNoVacio(document.getElementById("login-usuario").value, "tu nombre de usuario"),
    "login-clave": () => validarNoVacio(document.getElementById("login-clave").value, "tu contraseña")
  }, "indexlogueado.html");

  configurarFormulario(document.getElementById("form-registro"), {
    "reg-usuario": () => validarUsuario(document.getElementById("reg-usuario").value),
    "reg-clave": () => validarContrasena(document.getElementById("reg-clave").value),
    "reg-clave2": () => validarRepeticion(document.getElementById("reg-clave2").value, document.getElementById("reg-clave").value),
    "reg-email": () => validarCorreo(document.getElementById("reg-email").value),
    "reg-sexo-mujer": () => document.querySelector('input[name="sexo"]:checked') ? "" : "Selecciona una opción de sexo.",
    "reg-nacimiento": () => validarNacimiento(document.getElementById("reg-nacimiento").value)
  }, "indexlogueado.html");
});
