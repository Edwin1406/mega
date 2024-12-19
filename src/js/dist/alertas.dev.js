"use strict";

(function () {
  var alertaCotizador = document.querySelector('div .exito');

  if (alertaCotizador) {
    setTimeout(function () {
      alertaCotizador.remove();
    }, 3000);
  }
})();