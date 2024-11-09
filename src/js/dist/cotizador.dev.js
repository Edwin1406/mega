"use strict";

(function () {
  var test = {
    liner_id: '',
    pedido_id: '',
    pedido2_id: '',
    bobinaInterna_id: '',
    bobinaIntermedia_id: '',
    bobinaExterna_id: ''
  };
  var copiaTest = [];
  var copiaBobinas = []; // obtener datos del api de test

  function ApiTest() {
    var liner_id, url, resultado, apitest;
    return regeneratorRuntime.async(function ApiTest$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            liner_id = test.liner_id;
            _context.prev = 1;
            url = "".concat(location.origin, "/admin/api/test?liner_id=").concat(liner_id);
            _context.next = 5;
            return regeneratorRuntime.awrap(fetch(url));

          case 5:
            resultado = _context.sent;
            _context.next = 8;
            return regeneratorRuntime.awrap(resultado.json());

          case 8:
            apitest = _context.sent;
            copiarDatos(apitest);
            console.log(apitest);
            _context.next = 16;
            break;

          case 13:
            _context.prev = 13;
            _context.t0 = _context["catch"](1);
            console.log(_context.t0);

          case 16:
          case "end":
            return _context.stop();
        }
      }
    }, null, null, [[1, 13]]);
  }

  function ApiBobinas() {
    var bobinaInterna_id, url, resultado, apibobinas;
    return regeneratorRuntime.async(function ApiBobinas$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            bobinaInterna_id = test.bobinaInterna_id;
            _context2.prev = 1;
            url = "".concat(location.origin, "/admin/api/apibobinas?bobinaInterna_id=").concat(bobinaInterna_id);
            _context2.next = 5;
            return regeneratorRuntime.awrap(fetch(url));

          case 5:
            resultado = _context2.sent;
            _context2.next = 8;
            return regeneratorRuntime.awrap(resultado.json());

          case 8:
            apibobinas = _context2.sent;
            console.log(apibobinas);
            copiarDatos(apibobinas);
            _context2.next = 16;
            break;

          case 13:
            _context2.prev = 13;
            _context2.t0 = _context2["catch"](1);
            console.log(_context2.t0);

          case 16:
          case "end":
            return _context2.stop();
        }
      }
    }, null, null, [[1, 13]]);
  }

  function copiarDatos(apitest, apibobinas) {
    copiaTest = apitest;
    copiaBobinas = apibobinas;
    console.log("copia de test:".concat(copiaTest));
    console.log("copia de bobinas:".concat(copiaBobinas));
  }

  function ApiBobina_externa() {
    var bobinaExterna_id, url, resultado, apibobinas;
    return regeneratorRuntime.async(function ApiBobina_externa$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            bobinaExterna_id = test.bobinaExterna_id;
            _context3.prev = 1;
            url = "".concat(location.origin, "/admin/api/apibobina_externa?bobinaExterna_id=").concat(bobinaExterna_id);
            _context3.next = 5;
            return regeneratorRuntime.awrap(fetch(url));

          case 5:
            resultado = _context3.sent;
            _context3.next = 8;
            return regeneratorRuntime.awrap(resultado.json());

          case 8:
            apibobinas = _context3.sent;
            console.log(apibobinas); // mostrarApibobinas(apibobinas);

            _context3.next = 15;
            break;

          case 12:
            _context3.prev = 12;
            _context3.t0 = _context3["catch"](1);
            console.log(_context3.t0);

          case 15:
          case "end":
            return _context3.stop();
        }
      }
    }, null, null, [[1, 12]]);
  }

  function ApiBobina_media() {
    var bobinaIntermedia_id, url, resultado, apibobinas;
    return regeneratorRuntime.async(function ApiBobina_media$(_context4) {
      while (1) {
        switch (_context4.prev = _context4.next) {
          case 0:
            bobinaIntermedia_id = test.bobinaIntermedia_id;
            _context4.prev = 1;
            url = "".concat(location.origin, "/admin/api/apibobina_media?bobinaIntermedia_id=").concat(bobinaIntermedia_id);
            _context4.next = 5;
            return regeneratorRuntime.awrap(fetch(url));

          case 5:
            resultado = _context4.sent;
            _context4.next = 8;
            return regeneratorRuntime.awrap(resultado.json());

          case 8:
            apibobinas = _context4.sent;
            console.log(apibobinas); // mostrarApibobinas(apibobinas);

            _context4.next = 15;
            break;

          case 12:
            _context4.prev = 12;
            _context4.t0 = _context4["catch"](1);
            console.log(_context4.t0);

          case 15:
          case "end":
            return _context4.stop();
        }
      }
    }, null, null, [[1, 12]]);
  }

  var pedidos = document.querySelector('.pedidos');

  if (pedidos) {
    var busqueda = function busqueda(e) {
      // los pedidos no pueden ser iguales
      if ((e.target.name === 'pedido_id' || e.target.name === 'pedido2_id') && pedido.value === pedido2.value) {
        pedido2.value = '';
        Swal.fire("Pedido ya seleccionado", "No puede seleccionar el mismo pedido", "error");
        return;
      } else {
        test[e.target.name] = e.target.value.trim();
        console.log(test);
        ApiBobinas();
        ApiTest();
        ApiBobina_externa();
        ApiBobina_media();
      }
    };

    var liner = document.querySelector('[name="liner_id"]');
    var pedido = document.querySelector('[name="pedido_id"]');
    var pedido2 = document.querySelector('[name="pedido2_id"]');
    var bobinaInterna = document.querySelector('[name="bobinaInterna_id"]');
    var bobinaIntermedia = document.querySelector('[name="bobinaIntermedia_id"]');
    var bobinaExterna = document.querySelector('[name="bobinaExterna_id"]');
    liner.addEventListener('change', busqueda);
    pedido.addEventListener('change', busqueda);
    pedido2.addEventListener('change', busqueda);
    bobinaInterna.addEventListener('change', busqueda);
    bobinaIntermedia.addEventListener('change', busqueda);
    bobinaExterna.addEventListener('change', busqueda);
  }
})();