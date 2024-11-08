<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

<form method="POST" action="/admin/produccion/subirexcel/crear"  class="formulario" enctype="multipart/form-data">
    <label for="file">Subir archivo Excel:</label>
    <input type="file" name="file" id="file" accept=".xlsx, .xls">
    <input type="submit" name="submit" value="Subir">
</form>
</div>





<script>
productos();
async function productos(){
       
        try {
            const url = `${location.origin}/admin/api/productos`;
            const resultado = await fetch(url);
            const apibobinas = await resultado.json();
            console.log(apibobinas);
            // mostrarApibobinas(apibobinas);
           
        } catch (e) {
          console.log(e);
            
        }
    
    }


</script>