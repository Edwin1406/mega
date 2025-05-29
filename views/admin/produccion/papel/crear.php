<h2 class="dashboard__heading"> <?php echo $titulo2 ?> </h2>
<style>
    .item {
        background-color: #24292d;
        color: #f8f2f2;
        padding: 10px 15px;
        transition: all 0.5s;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    
    .item:nth-child(1), .item:nth-child(2), .item:nth-child(3), .item:nth-child(4), .item:nth-child(5),.item:nth-child(6),.item:nth-child(7),.item:nth-child(8),.item:nth-child(9),.item:nth-child(10) {
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
      font-size: 1.5rem;
      
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
    <div class="item"><a href="/admin/produccion/estimar/index?id=20255"> <i class="fas fa-home"></i>CORRUGADOR</a></div>
    <div class="item"><a href="/admin/produccion/estimar/micro"> <i class="fas fa-industry"></i>MICRO</a></div>
    <div class="item"><a href="/admin/produccion/estimar/cajas"> <i class="fas fa-scroll"></i> FLEXOGRAFICA</a></div>
    <div class="item"><a href="/admin/produccion/estimar/separadores">  <i class="fas fa-newspaper"></i>PREPRINTER</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_generales/index">  <i class="fa-solid fa-calculator"></i>BODLADO</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_papel">  <i class="fa-solid fa-money-bill-1"></i> CORTE CEJA</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_papel">  <i class="fa-solid fa-money-bill-1"></i> TROQUEL</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_papel">  <i class="fa-solid fa-money-bill-1"></i> GUILLOTINA LAMINA</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_papel">  <i class="fa-solid fa-money-bill-1"></i> GUILLOTINA PAPEL</a></div>
    <div class="item"><a href="/admin/produccion/estimar/costos_papel">  <i class="fa-solid fa-money-bill-1"></i> EMPAQUE</a></div>
</div>


<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">

        
    </form>

</div>

