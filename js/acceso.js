// Acceso de demostración para la práctica estática, sin autenticación de servidor.
// El navegador valida los campos antes de emitir el evento submit.
document.querySelectorAll('form[data-acceso-estatico]').forEach((formulario) => {
  formulario.addEventListener('submit', (evento) => {
    evento.preventDefault();
    window.location.assign(formulario.action);
  });
});
