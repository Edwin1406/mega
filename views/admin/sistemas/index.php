<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<style>
    .item {
      background-color: #24292d;
      color: #f8f2f2;
      padding: 10px 15px;
      transition: all 0.5s;
    }
    
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    
    .item:nth-child(1), .item:nth-child(2), .item:nth-child(3), .item:nth-child(4), .item:nth-child(5) {
      width: 10%;
    }

    .item:hover {
      background-color: #ac5353;
      scale: 1.1;
      text-align: center;
    }

    .item a {
      color: inherit;
      text-decoration: none;
      display: block;
    }
    @media (min-width: 1024px) {
    .item:nth-child(1) {
      width: 20%;
    }
    
    .item:nth-child(2) {
      width: 20%;
    }
    
    .item:nth-child(3) {
      width: 20%;
    }
    
    .item:nth-child(4) {
      width: 20%;
    }
    
    .item:nth-child(5) {
      width: 20%;
    }


    
  }

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <div class="item"><a href="/admin/sistemas/index?id=80ad04ffdfb4872f9b4603cdf4932f23"> <i class="fas fa-home"></i> INICIO</a></div>
    <div class="item"><a href="/admin/sistemas/productos/crear"> <i class="fas fa-industry"></i> PRODUCTOS</a></div>
  <div class="item"><a href="/admin/sistemas/productos/tabla"> <i class="fas fa-scroll"></i> TABLA</a></div>
  <div class="item"><a href="/admin/sistemas/movimiento/movimientos">  <i class="fas fa-newspaper"></i> MOVIMIENTOS</a></div>
  <div class="item"><a href="/admin/sistemas/productos/gastos"><i class="fa-solid fa-arrow-right"></i> GASTOS</a></div>
</div>




    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>

document.addEventListener('DOMContentLoaded', async function() {
        datosapi();
      });

      async function datosapi() {
        const url = 'https://megawebsistem.com/admin/api/apimovimientos';
        const response = await fetch(url);
        const data = await response.json();
       console.log(data);
        return data;
      }





        // Datos del gráfico con 3 datasets
        const data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Dataset 1',
                data: [50, 60, 70, 80, 90, 100, 110],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Dataset 2',
                data: [30, 40, 50, 60, 70, 80, 90],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Dataset 3',
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configuración del gráfico
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        };

        // Creación del gráfico
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, config);
    </script>