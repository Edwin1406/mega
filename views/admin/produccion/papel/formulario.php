<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery y Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>


/* Contenedor principal del select2 */
.select2-container .select2-selection--single {
    height: 42px;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 2rem;
    font-family: inherit;
    background-color: white;
    box-shadow: none;
    transition: border-color 0.2s ease-in-out;
}



</style>
<!-- Tipo Maquina -->
<select id="tipo_maquina">
  <option value="">-- Selecciona tipo --</option>
  <option value="CORRUGADOR">CORRUGADOR</option>
  <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
</select>

<!-- Clasificación -->
<select id="clasificacion">
  <option value="">-- Clasificación --</option>
  <option value="OPERATIVO">OPERATIVO</option>
  <option value="NO OPERATIVO">NO OPERATIVO</option>
</select>

<!-- Contenedor de campos dinámicos -->
<div id="campos_dinamicos"></div>

<!-- Estilos rápidos para ejemplo visual -->
<style>
  #campos_dinamicos label {
    display: block;
    margin-top: 5px;
    font-weight: bold;
  }
  #campos_dinamicos input {
    margin-bottom: 10px;
    width: 200px;
  }
</style>

<!-- Script -->
<script>
  const camposPorTipoClasificacion = {
    CORRUGADOR: {
      OPERATIVO: ["Empalme", "Cambio", "Recubrimiento"]
    },
    ADMINISTRATIVO: {
      OPERATIVO: ["Papel"],
      "NO OPERATIVO": ["Bom"]
    }
  };

  function mostrarCampos(tipo, clasificacion) {
    const contenedor = document.getElementById("campos_dinamicos");
    contenedor.innerHTML = ""; // Limpia todo

    const campos = (camposPorTipoClasificacion[tipo] || {})[clasificacion] || [];

    campos.forEach(campo => {
      const label = document.createElement("label");
      label.textContent = `${campo}:`;

      const input = document.createElement("input");
      input.type = "number";
      input.name = campo.toLowerCase().replace(/\s+/g, '_');
      input.placeholder = "Peso (kg)";

      contenedor.appendChild(label);
      contenedor.appendChild(input);
    });
  }

  document.getElementById("tipo_maquina").addEventListener("change", function () {
    const tipo = this.value;
    const clasificacion = document.getElementById("clasificacion").value;
    mostrarCampos(tipo, clasificacion);
  });

  document.getElementById("clasificacion").addEventListener("change", function () {
    const tipo = document.getElementById("tipo_maquina").value;
    const clasificacion = this.value;
    mostrarCampos(tipo, clasificacion);
  });
</script>
