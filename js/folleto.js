"use strict";

// Tarifas originales de la práctica anterior, aplicadas por bloques de páginas.
const TARIFAS = Object.freeze({
  envio: 10,
  paginasPrimerBloque: 2,
  paginasSegundoBloque: 1.8,
  paginasTercerBloque: 1.6,
  fotoColor: 0.5,
  fotoAltaResolucion: 0.2
});

function calcularCostePaginas(paginas) {
  const primerBloque = Math.min(paginas, 4);
  const segundoBloque = Math.min(Math.max(paginas - 4, 0), 6);
  const tercerBloque = Math.max(paginas - 10, 0);
  return TARIFAS.envio + primerBloque * TARIFAS.paginasPrimerBloque +
    segundoBloque * TARIFAS.paginasSegundoBloque +
    tercerBloque * TARIFAS.paginasTercerBloque;
}

function calcularCosteFolleto(paginas, fotos, color, altaResolucion) {
  return calcularCostePaginas(paginas) +
    (color ? fotos * TARIFAS.fotoColor : 0) +
    (altaResolucion ? fotos * TARIFAS.fotoAltaResolucion : 0);
}

function agregarCelda(fila, etiqueta, texto, opciones = {}) {
  const celda = document.createElement(etiqueta);
  if (opciones.colSpan) celda.colSpan = opciones.colSpan;
  if (opciones.rowSpan) celda.rowSpan = opciones.rowSpan;
  if (opciones.scope) celda.scope = opciones.scope;
  celda.appendChild(document.createTextNode(String(texto)));
  fila.appendChild(celda);
  return celda;
}

function crearTablaCostes() {
  const tabla = document.createElement("table");
  tabla.className = "tabla-costes";
  const titulo = document.createElement("caption");
  titulo.appendChild(document.createTextNode("Posibles costes del folleto publicitario impreso"));
  tabla.appendChild(titulo);

  const encabezado = document.createElement("thead");
  const fila1 = document.createElement("tr");
  agregarCelda(fila1, "th", "Número de páginas", { rowSpan: 2, scope: "col" });
  agregarCelda(fila1, "th", "Número de fotos", { rowSpan: 2, scope: "col" });
  agregarCelda(fila1, "th", "Blanco y negro", { colSpan: 2, scope: "colgroup" });
  agregarCelda(fila1, "th", "Color", { colSpan: 2, scope: "colgroup" });
  encabezado.appendChild(fila1);

  const fila2 = document.createElement("tr");
  for (const resolucion of ["150-300 dpi", "450-900 dpi", "150-300 dpi", "450-900 dpi"]) {
    agregarCelda(fila2, "th", resolucion, { scope: "col" });
  }
  encabezado.appendChild(fila2);
  tabla.appendChild(encabezado);

  const cuerpo = document.createElement("tbody");
  for (let paginas = 1; paginas <= 15; paginas++) {
    const fotos = paginas * 3;
    const fila = document.createElement("tr");
    agregarCelda(fila, "th", paginas, { scope: "row" });
    agregarCelda(fila, "td", fotos);
    for (const [color, alta] of [[false, false], [false, true], [true, false], [true, true]]) {
      const importe = calcularCosteFolleto(paginas, fotos, color, alta);
      agregarCelda(fila, "td", `${importe.toFixed(2).replace(".", ",")} €`);
    }
    cuerpo.appendChild(fila);
  }
  tabla.appendChild(cuerpo);
  return tabla;
}

document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("contenedor-costes");
  const boton = document.getElementById("alternar-costes");
  if (!contenedor || !boton) return;
  contenedor.appendChild(crearTablaCostes());

  const resolucion = document.getElementById("resolucion");
  const valorResolucion = document.getElementById("valorResolucion");
  if (resolucion && valorResolucion) {
    resolucion.addEventListener("input", () => {
      valorResolucion.value = resolucion.value;
    });
  }

  boton.addEventListener("click", () => {
    contenedor.hidden = !contenedor.hidden;
    const visible = !contenedor.hidden;
    boton.setAttribute("aria-expanded", String(visible));
    boton.textContent = visible ? "Ocultar tabla de costes" : "Mostrar tabla de costes";
  });
});
