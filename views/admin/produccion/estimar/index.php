<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<style>
    .item {
      background-color: #24292d;
      color: #f8f2f2;
      padding: 10px 15px;
      transition: all 0.5s;
      display: flex;
      justify-content: center;
      align-items: center;
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
      background-color: #d5f5e3;
      scale: 1.1;
      color: #24292d;
      border-radius: 1rem;
    }

    .item a {
      color: inherit;
      text-decoration: none;
      display: block;
      text-align: center;
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

<div class="container">
    <div class="item"><a href="/admin/produccion/estimar/index?id=20255"> <i class="fas fa-home"></i> INICIO</a></div>
    <div class="item"><a href="/admin/produccion/"> <i class="fas fa-industry"></i> COTIZADOR MICRO</a></div>
    <div class="item"><a href="/admin/produccion/"> <i class="fas fa-scroll"></i> COTIZADOR CAJAS</a></div>
    <div class="item"><a href="/admin/produccion/">  <i class="fas fa-newspaper"></i> COTIZADOR SEPARADORES</a></div>
    <div class="item"><a href="/admin/produccion/">  <i class="fa-solid fa-calculator"></i> COSTOS GENERALES</a></div>
    <div class="item"><a href="/admin/produccion/">  <i class="fa-solid fa-money-bill-1"></i> COSTOS PAPEL</a></div>
</div>

