<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<ul class="lista-areas-produccion">
    <li class="areas-produccion-craft">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO KRAFT :
            <?php if ($totalCostoK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoK ?> $ </span>
            <?php endif; ?>
        </a>
    </li>
</ul>




<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <div id="filters">
      <div>
        <label for="filterGramaje">Filtrar por Gramaje:</label>
        <select id="filterGramaje">
          <option value="all">Todos</option>
        </select>
      </div>
      <div>
        <label for="filterAncho">Filtrar por Ancho:</label>
        <select id="filterAncho">
          <option value="all">Todos</option>
        </select>
      </div>
    </div>

<div class="graficas_blancas">
  <div id="chart" class="tamaño"></div>
</div>


  <table id="dataTable" >
    <thead>
      <tr>
        <th>Ancho</th>
        <th>Gramaje</th>
        <th>Existencia</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>


