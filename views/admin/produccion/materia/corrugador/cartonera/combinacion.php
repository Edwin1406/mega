
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Combinación</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="" method="post">
                <div class="form-group
                    <label for="bobina-1880">Bobina 1880</label>
                    <input type="number" class="form-control" id="bobina-1880" name="bobina-1880" value="0">
                </div>
                <div class="form-group
                    <label for="bobina-1100">Bobina 1100</label>
                    <input type="number" class="form-control" id="bobina-1100" name="bobina-1100" value="0">
                </div>
                <div class="form-group
                    <label for="total">Total</label>
                    <input type="number" class="form-control" id="total" name="total" value="0" readonly>   
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>


<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];

    const bobinas = [1880, 1100];

    for(const bobina of bobinas) {
        const input = document.getElementById(`bobina-${bobina}`);
        input.addEventListener("input", () => {
            const total = bobinas.reduce((acc, bobina) => {
                const input = document.getElementById(`bobina-${bobina}`);
                return acc + (input.value ? parseInt(input.value) : 0);
            }, 0);
            document.getElementById("total").value = total;
        });

    }



});

</script>