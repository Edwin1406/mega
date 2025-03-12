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

<div class="container">
    <div class="item"><a href="/admin/sistemas/index?id=80ad04ffdfb4872f9b4603cdf4932f23"> <i class="fas fa-home"></i> INICIO</a></div>
    <div class="item"><a href="/admin/sistemas/productos/crear"> <i class="fas fa-industry"></i> PRODUCTOS</a></div>
  <div class="item"><a href="/admin/produccion/materia/microcorrugador"> <i class="fas fa-scroll"></i> TABLA</a></div>
  <div class="item"><a href="/admin/produccion/materia/periodico">  <i class="fas fa-newspaper"></i> PERIÓDICO</a></div>
  <div class="item"><a href="/admin/produccion/materia/excel"><i class="fa-solid fa-arrow-right"></i> SUBIR EXCEL</a></div>
</div>



<div class="dashboard__formulario">

<?php include_once __DIR__.'/templates/alertas.php'  ?>

    <form method="POST" action="/admin/sistemas/productos/crear "  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Maquina">

        
    </form>

</div>