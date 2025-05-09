<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="grafica">
  <div class="tamaño">
    <canvas id="producto-grafica"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart2"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart3"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart4"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart5"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Primer gráfico: Bar
  const grafica = document.querySelector('#producto-grafica');

  if(grafica){

        const ctx1 = document.getElementById('producto-grafica');
      new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
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



  }
 

  // Segundo gráfico: Line
  const ctx2 = document.getElementById('myChart2');
  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [15, 10, 7, 8, 5, 6],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 2,
        fill: true
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

  // Tercer gráfico: Pie
  const ctx3 = document.getElementById('myChart3');
  new Chart(ctx3, {
    type: 'line',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [15, 10, 7, 8, 5, 6],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(25, 99, 132, 4)',
        borderWidth: 2,
        fill: true
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

  // Cuarto gráfico: Doughnut
  const ctx4 = document.getElementById('myChart4');
  new Chart(ctx4, {
    type: 'doughnut',
    data: {
      labels: ['Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [15, 25, 10],
        backgroundColor: ['green', 'purple', 'orange'],
      }]
    }
  });

  // Quinto gráfico: Radar
  const ctx5 = document.getElementById('myChart5');
  new Chart(ctx5, {
    type: 'radar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
      datasets: [{
        label: 'My First Dataset',
        data: [20, 10, 4, 2, 6],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 2
      }]
    }
  });
</script>
