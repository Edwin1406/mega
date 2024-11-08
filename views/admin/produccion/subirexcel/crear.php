<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>



<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Subir archivo Excel:</label>
    <input type="file" name="file" id="file" accept=".xlsx, .xls">
    <input type="submit" name="submit" value="Subir">
</form>
