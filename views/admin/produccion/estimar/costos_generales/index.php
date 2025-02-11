<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<style>

    .body {
        background-image: linear-gradient(to right, #94a1b5, #7ea6b5, #72aaa8, #7baa90, #97a676) !important;
    }
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
      background-color: #d6eaf8;
      scale: 1.1;
      color: #24292d;
      border-radius: 1rem;
    }

    .item a {
      color: inherit;
      text-decoration: none;
      display: block;
      text-align: center;
      font-size: 1.6rem;
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
          <div class="item"><a href="/admin/produccion/estimar/micro"> <i class="fas fa-industry"></i>MATERIA PRIMA</a></div>
          <div class="item"><a href="/admin/produccion/estimar/cajas"> <i class="fas fa-scroll"></i> INSUMOS </a></div>
          <div class="item"><a href="/admin/produccion/estimar/separadores">  <i class="fas fa-newspaper"></i> RUBROS</a></div>
        </div>





