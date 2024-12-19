"use strict";

(function () {
  var maquinaInput = document.querySelector('#maquina_id');

  if (maquinaInput) {
    var obtenerMaquinas = function obtenerMaquinas() {
      var url, respuesta;
      return regeneratorRuntime.async(function obtenerMaquinas$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              url = "".concat(location.origin, "/admin/api/maquinas");
              ;
              _context.next = 4;
              return regeneratorRuntime.awrap(fetch(url));

            case 4:
              respuesta = _context.sent;
              _context.next = 7;
              return regeneratorRuntime.awrap(respuesta.json());

            case 7:
              resultado = _context.sent;
              formatearMaquinas(resultado);

            case 9:
            case "end":
              return _context.stop();
          }
        }
      });
    };

    var formatearMaquinas = function formatearMaquinas() {
      var arrayMaquinas = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      maquinas = arrayMaquinas.map(function (maquina) {
        return {
          nombre: "".concat(maquina.nombre.trim()),
          id: maquina.id
        };
      });
      console.log(maquinas);
    };

    var buscarMaquinas = function buscarMaquinas(e) {
      var busqueda = e.target.value;

      if (busqueda.length > 3) {
        var expresion = new RegExp(busqueda, 'i');
        maquinasFiltradas = maquinas.filter(function (maquina) {
          if (maquina.nombre.toLowerCase().search(expresion) != -1) {
            return maquina;
          }
        });
      } else {
        maquinasFiltradas = [];
      }

      mostrarMaquinas();
    };

    var mostrarMaquinas = function mostrarMaquinas() {
      while (listadoMaquinas.firstChild) {
        listadoMaquinas.removeChild(listadoMaquinas.firstChild);
      }

      if (maquinasFiltradas.length > 0) {
        maquinasFiltradas.forEach(function (maquina) {
          var maquinaHTML = document.createElement('LI');
          maquinaHTML.classList.add('listado-maquinas__maquina');
          maquinaHTML.textContent = maquina.nombre;
          maquinaHTML.dataset.id = maquina.id; // anadir al html

          listadoMaquinas.appendChild(maquinaHTML);
        });
      } else {
        var noResultado = document.createElement('P');
        noResultado.classList.add('listado-maquinas__no-resultado');
        noResultado.textContent = 'No hay resultados';
        listadoMaquinas.appendChild(noResultado);
      }
    };

    var maquinas = [];
    var maquinasFiltradas = [];
    var listadoMaquinas = document.querySelector('#listado-maquinas');
    obtenerMaquinas();
    maquinaInput.addEventListener('input', buscarMaquinas);
  }
})();