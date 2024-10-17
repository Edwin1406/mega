<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<div style="display: flex;">
  <div>
    <canvas id="myChart1"></canvas>
  </div>
  <div>
    <canvas id="myChart2"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Primer gráfico
  const ctx1 = document.getElementById('myChart1');
  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Segundo gráfico
  const ctx2 = document.getElementById('myChart2');
  new Chart(ctx2, {
    type: 'line', // Tipo diferente para mostrar variedad
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [15, 10, 7, 8, 5, 6],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
