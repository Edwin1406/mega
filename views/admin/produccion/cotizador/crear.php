<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/cotizador/tabla">
    <i class="fa-regular fa-eye"></i>
        VER TABLA DE COTIZADOR
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/cotizador/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Cotizacion">

        
    </form>

</div>


<?php $curl
=
curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://webservices.ec/api/ruc/{1716999303001}',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10, 
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
),
'Accept: application/json',
'Authorization: Bearer {E1AojmTPanzGXsvJW4817aByPpluAkWwU7UjDxly}'
));
$response
=
curl_exec($curl);