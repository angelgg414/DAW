# Práctica 6: JavaScript

Se han añadido las siguientes funciones, sin
frameworks ni expresiones regulares:

- `index.html` y `login.html`: validación de los dos campos de acceso.
- `registro.html`: validación manual de usuario, contraseña, repetición, email
  (incluyendo límites por subdominio), sexo y fecha válida con mayoría de edad
  comprobada el día real de uso, no con una fecha fija.
- `solicitarfolleto.html`: generación DOM nodo a nodo de 15 filas y cuatro
  importes por fila según las tarifas, por bloques
  de páginas. La tabla se muestra/oculta con un botón y no depende del formulario.
- `js/validaciones.js`, `js/folleto.js` y `css/validacion.css`: lógica y estilo
  separados del HTML. Los avisos se muestran junto a cada campo y se resalta el
  control incorrecto; no se usan `alert()`, `pattern`, `type="email"` ni
  `type="date"` para validar el registro.

**Cómo probarla:** abrir `index.html` en Chrome o Firefox, probar el inicio de
sesión vacío y con espacios, y repetir con `login.html`. En `registro.html`,
introducir distintos valores inválidos para cada campo y verificar que aparece
un mensaje claro. En `solicitarfolleto.html`, pulsar «Mostrar tabla de costes»:
la primera fila debe ser 12,00 €, 12,60 €, 13,50 €, 14,10 € y la fila 15,
36,80 €, 45,80 €, 59,30 €, 68,30 €.

**Nota:** el proyecto sigue siendo una maqueta HTML estática: un acceso o registro
válido navega a la zona privada de demostración, pero no autentica usuarios ni
almacena sus datos. La validación en JavaScript no sustituye a la validación de
servidor cuando se programe PHP.

---

# Práctica 5: CSS (2)

Abre `index.html` en Mozilla Firefox y elige un estilo en **Ver > Estilo de
página** (pulsa Alt si no ves la barra de menús). Chrome no tiene esta opción.

## Estilos de la práctica 5

| Estilo (title) | Tipo | Hojas |
| --- | --- | --- |
| *(sin título)* | Persistente | `variables`, `base`, `estructura`, `formularios`, `tablas`, `adaptativo` |
| Estilo predeterminado | Preferida | `claro.css` |
| Modo noche | Alternativa | `noche.css` |
| Alto contraste | Alternativa | `contraste.css` |
| Letra grande | Alternativa | `claro.css` + `letragrande.css` |
| Alto contraste y letra grande | Alternativa | `contraste.css` + `letragrande.css` |
| Vista previa de impresión | Alternativa | `impresion.css` (para comprobar la impresión en pantalla) |
| *(sin título)* | Impresión (`media="print"`) | `impresion.css` |

- Los colores salen de `variables.css` y pasan a la hoja de tema. Las hojas
  persistentes solo usan variables, así que cada tema redefine la paleta sin
  repetir reglas.
- «Letra grande» y «Alto contraste y letra grande» reutilizan las mismas
  hojas agrupándolas con el mismo `title`, en lugar de duplicar código.
- Las hojas de pantalla llevan `media="screen"` para no interferir en la
  impresión, y la de impresión no tiene `title` para aplicarse siempre.
- Contrastes (WCAG): el estilo predeterminado ya cumple AA (texto 14:1,
  enlaces 6,4:1), así que el de alto contraste se ha hecho para AAA (≥ 7:1).
- `accesibilidad.html` es la declaración de accesibilidad, enlazada desde el
  pie de todas las páginas.

---

# Práctica 4: CSS (1)

Abre `index.html` en un navegador para ver el sitio. Todas las páginas y la
plantilla `esqueleto.html` comparten las mismas hojas de estilo.

## Organización del CSS

| Archivo | Responsabilidad |
| --- | --- |
| `css/variables.css` | Colores, tipografías, espacios y ancho máximo del tema. |
| `css/base.css` | Elementos comunes, tipografía y enlace para saltar al contenido. |
| `css/estructura.css` | Cabecera, navegación, anuncios, detalle, galería y pie. |
| `css/formularios.css` | Alineación de etiquetas, controles, opciones y botones. |
| `css/tablas.css` | Tarifas, cabecera, bordes y filas alternas. |
| `css/adaptativo.css` | Cambios de distribución según el ancho de pantalla. |

Las hojas se enlazan en ese orden. Para las variantes de la próxima práctica,
se pueden sobrescribir las variables del tema con una hoja adicional.

## Requisitos aplicados

- Propiedades `color`, `font`, `background`, `border`, `margin` y `padding`.
- Clases compartidas, como `.anuncio`, `.campo` y `.saltar-contenido`.
- Enlace «Saltar al contenido principal» en las 16 páginas: aparece al pulsar
  Tab y dirige el foco a `main#contenido` al pulsar Intro.
- Formularios con etiquetas alineadas en dos columnas desde 640 px y encima
  de los controles en pantallas pequeñas. Las opciones de radio y las casillas
  mantienen sus etiquetas junto a cada control.
- Anuncios en una columna por debajo de 640 px, dos desde 640 px, tres desde
  1024 px y cuatro desde 1440 px (tres en la zona privada para dejar espacio
  al menú lateral). Las imágenes se adaptan al espacio disponible.
- Biblioteca Material Symbols en la navegación, siguiendo su
  [documentación oficial](https://developers.google.com/fonts/docs/material_symbols).
  Los iconos decorativos tienen `aria-hidden="true"` y se conserva el texto de
  los enlaces. La biblioteca se carga desde Google Fonts y necesita conexión;
  el contenido y la navegación siguen disponibles sin ella.
- Icono Unicode de sobre (`&#9993;`) junto al enlace de contacto del pie.
- Dos familias tipográficas: Georgia para títulos y Arial para el texto.

## Comprobaciones realizadas

Se han revisado las 13 páginas en Chrome a 480, 768, 1280 y 1920 px
(52 combinaciones) en la primera versión, y las 16 páginas tras incorporar
la parte privada (64 combinaciones). No se ha detectado desbordamiento horizontal ni imágenes
sin cargar. Se han comprobado la carga de las seis hojas CSS, los identificadores
únicos, las asociaciones de etiquetas y controles y el número de columnas.
También se ha probado el enlace de salto con Tab e Intro y se ha revisado
visualmente la portada y Mis mensajes a 480 y 1920 px. El salto mediante teclado
se ha probado en las 16 páginas y el formulario de mensaje llega a su respuesta.

## Páginas privadas y enlaces

`mismensajes.html`, `respuestamensaje.html` y `esqueletoprivado.html` usan el tema
común. El menú de usuario aparece sobre el contenido en pantallas pequeñas y en
una columna lateral desde 1024 px. Las tablas de mensajes tienen una cabecera
semántica y una región con desplazamiento horizontal y acceso por teclado para
mantener la legibilidad de sus cuatro columnas en móvil.

El formulario de `mensaje.html` apunta a `respuestamensaje.html` y usa GET para
poder abrir esa página en un sitio estático. La confirmación y los mensajes son
datos de ejemplo; todavía no hay almacenamiento ni envío real de mensajes.

Se han comprobado los destinos de `href`, `src` y `action`, incluidos los
fragmentos internos. Los enlaces a `404.html` de Mis datos, Mis anuncios,
Publicar anuncio, Darme de baja, recuperación de contraseña, perfiles de
anunciantes, Compartir, Aviso legal y Contacto siguen pendientes de sus páginas:
esas funciones no están implementadas en los HTML actuales del repositorio.

Estas comprobaciones no sustituyen una validación completa de HTML y CSS con
los servicios del W3C. Los formularios conservan las acciones de la práctica
anterior y la respuesta del folleto mantiene sus datos de ejemplo.
