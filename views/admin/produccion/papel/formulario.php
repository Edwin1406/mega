<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery y Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>
    /* Contenedor principal del select2 */
    .select2-container .select2-selection--single {
        height: 42px;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 2rem;
        font-family: inherit;
        background-color: white;
        box-shadow: none;
        transition: border-color 0.2s ease-in-out;
    }


    .formulario__campo {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 columnas iguales */
        gap: 1rem;
        /* Espacio entre columnas */
        margin-top: 1rem;

    }


    .dashboard__formulario {
        width: 120rem;
        margin: 0 auto;
    }



    .formulario__input {
        padding: 1rem;
        border: 1px solid #64748B;
        border-radius: 1rem;
        width: 14rem;
    }

    .formulario__legend {
        text-align: center;
    }

    .formulario_campito {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 columnas iguales */
        gap: 1.5rem;
        /* Espacio entre columnas */
        margin-top: 1rem;
    }


    .formulario__submit {
        margin-top: 3rem;
        align-self: center;
    }

    @media (max-width: 1024px) {
        .formulario {
            grid-template-columns: repeat(2, 1fr);
            /* 2 columnas en tablet */
        }
    }

    @media (max-width: 768px) {
        .formulario {
            grid-template-columns: 1fr;
            /* 1 columna en móvil */
        }
    }
</style>


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Papel</legend>
    <div class="formulario__campo">
        <label class="formulario__label1" for="tipo_maquina">Tipo Maquina</label>
        <select class="formulario__input1 select2" name="tipo_maquina" id="tipo_maquina">
            <option value="">-- Selecciona un tipo --</option>
            <option value="CORRUGADOR" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'corrugador' ? 'selected' : '' ?>>CORRUGADOR</option>
            <option value="MICRO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'micro' ? 'selected' : '' ?>>MICRO</option>
            <option value="FLEXOGRAFICA" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'flexografica' ? 'selected' : '' ?>>FLEXOGRAFICA</option>
            <option value="PREPRINTER" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'preprinter' ? 'selected' : '' ?>>PREPRINTER</option>
            <option value="DOBLADO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'doblado' ? 'selected' : '' ?>>DOBLADO</option>
            <option value="CORTE CEJA" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'corte ceja' ? 'selected' : '' ?>>CORTE CEJA</option>
            <option value="TROQUEL" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'troquel' ? 'selected' : '' ?>>TROQUEL</option>
            <option value="CONVERTIDOR" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'convertidor' ? 'selected' : '' ?>>CONVERTIDOR</option>
            <option value="GUILLOTINA LAMINA" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'guillotina lamina' ? 'selected' : '' ?>>GUILLOTINA LAMINA</option>
            <option value="GUILLOTINA PAPEL" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'guillotina papel' ? 'selected' : '' ?>>GUILLOTINA PAPEL</option>
            <option value="EMPAQUE" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'empaque' ? 'selected' : '' ?>>EMPAQUE</option>

        </select>
    </div>

<input type="hiden" name="id_orden" value="<?= $_GET['id_orden'] ?? '' ?>">


    <div class="formulario__campo">
        <label class="formulario__label">CLASIFICACION</label>

        <div>
            <label>
                <input type="checkbox" name="MDO[]" value="a">
                CONTROLABLE
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="MDO[]" value="b" checked>
                NO CONTROLABLE
            </label>
        </div>

        <input type="hidden" name="tipo_clasificacion" id="tipo_clasificacion">


    </div>



    <script>
        $(document).ready(function() {
            $('#tipo_maquina').select2({
                placeholder: "-- Selecciona un tipo --",
                allowClear: true,
            });
        });
    </script>
    <!-- CORRUGADOR  CONTROLABLE -->


    <div class="formulario_campito">
        <div class="formulario__campo">
            <label class="formulario__label" for="SINGLEFACE">SINGLE FACE</label>
            <input
                type="number"
                name="SINGLEFACE"
                id="SINGLEFACE"
                class="formulario__input"
                placeholder="SINGLEFACE"
                value="<?php echo $papel->SINGLEFACE ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="EMPALME">EMPALME</label>
            <input
                type="number"
                name="EMPALME"
                id="EMPALME"
                class="formulario__input"
                placeholder="EMPALME"
                value="<?php echo $papel->EMPALME ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="RECUB">RECUB</label>
            <input
                type="number"
                name="RECUB"
                id="RECUB"
                class="formulario__input"
                placeholder="RECUB"
                value="<?php echo $papel->RECUB ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="GALLET">GALLET</label>
            
<?php
if (!empty($_GET['id_orden']) && isset($papel) && strtoupper($papel->tipo_maquina ?? '') === 'FLEXOGRAFICA') {
    echo $orden;
}
?>


            <input
                type="number"
                name="GALLET"
                id="GALLET"
                class="formulario__input"
                placeholder="GALLET"
                value="<?php echo $papel->GALLET ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="HUMEDO">HUMEDO</label>
            <input
                type="number"
                name="HUMEDO"
                id="HUMEDO"
                class="formulario__input"
                placeholder="HUMEDO"
                value="<?php echo $papel->HUMEDO ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="COMBADO">COMBADO</label>
            <input
                type="number"
                name="COMBADO"
                id="COMBADO"
                class="formulario__input"
                placeholder="COMBADO"
                value="<?php echo $papel->COMBADO ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="DESPE">DESPE</label>
            <input
                type="number"
                name="DESPE"
                id="DESPE"
                class="formulario__input"
                placeholder="DESPE"
                value="<?php echo $papel->DESPE ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="ERROM">ERROM</label>
            <input
                type="number"
                name="ERROM"
                id="ERROM"
                class="formulario__input"
                placeholder="ERROM"
                value="<?php echo $papel->ERROM ?? '' ?>">
        </div>


        <!-- CORRUGADOR NO CONTROLABLE  -->
        <div class="formulario__campo">
            <label class="formulario__label" for="DESHOJE">DESHOJE</label>
            <input
                type="number"
                name="DESHOJE"
                id="DESHOJE"
                class="formulario__input"
                placeholder="DESHOJE"
                value="<?php echo $papel->DESHOJE ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="MECANICO">MECANICO</label>
            <input
                type="number"
                name="MECANICO"
                id="MECANICO"
                class="formulario__input"
                placeholder="MECANICO"
                value="<?php echo $papel->MECANICO ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="ELECTRICO">ELECTRICO</label>
            <input
                type="number"
                name="ELECTRICO"
                id="ELECTRICO"
                class="formulario__input"
                placeholder="ELECTRICO"
                value="<?php echo $papel->ELECTRICO ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="FILOS_ROTOS">FILOS ROTOS</label>
            <input
                type="number"
                name="FILOS_ROTOS"
                id="FILOS_ROTOS"
                class="formulario__input"
                placeholder="FILOS_ROTOS"
                value="<?php echo $papel->FILOS_ROTOS ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="REFILE_PEQUENO">REFILE PEQUEÑO</label>
            <input
                type="number"
                name="REFILE_PEQUENO"
                id="REFILE_PEQUENO"
                class="formulario__input"
                placeholder="REFILE_PEQUENO"
                value="<?php echo $papel->REFILE_PEQUENO ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="PEDIDOS_CORTOS">PEDIDOS CORTOS</label>
            <input
                type="number"
                name="PEDIDOS_CORTOS"
                id="PEDIDOS_CORTOS"
                class="formulario__input"
                placeholder="PEDIDOS_CORTOS"
                value="<?php echo $papel->PEDIDOS_CORTOS ?? '' ?>">
        </div>


        <div class="formulario__campo">
            <label class="formulario__label" for="DIFER_ANCHO">DIFER-ANCHO</label>
            <input
                type="number"
                name="DIFER_ANCHO"
                id="DIFER_ANCHO"
                class="formulario__input"
                placeholder="DIFER_ANCHO"
                value="<?php echo $papel->DIFER_ANCHO ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="SUSTRATO">SUSTRATO</label>
            <input
                type="number"
                name="SUSTRATO"
                id="SUSTRATO"
                class="formulario__input"
                placeholder="SUSTRATO"
                value="<?php echo $papel->SUSTRATO ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="CAMBIO_GRAMAJE">CAMBIO GRAMAJE</label>
            <input
                type="number"
                name="CAMBIO_GRAMAJE"
                id="CAMBIO_GRAMAJE"
                class="formulario__input"
                placeholder="CAMBIO_GRAMAJE"
                value="<?php echo $papel->CAMBIO_GRAMAJE ?? '' ?>">
        </div>



        <div class="formulario__campo">
            <label class="formulario__label" for="CAMBIO_PEDIDO">CAMBIO PEDIDO</label>
            <input
                type="number"
                name="CAMBIO_PEDIDO"
                id="CAMBIO_PEDIDO"
                class="formulario__input"
                placeholder="CAMBIO_PEDIDO"
                value="<?php echo $papel->CAMBIO_PEDIDO ?? '' ?>">
        </div>






        <div class="formulario__campo">
            <label class="formulario__label" for="EXTRA_TRIM">EXTRA TRIM </label>
            <input
                type="number"
                name="EXTRA_TRIM"
                id="EXTRA_TRIM"
                class="formulario__input"
                placeholder="EXTRA_TRIM"
                value="<?php echo $papel->EXTRA_TRIM ?? '' ?>">
        </div>






        <!-- MICRO   CONTROLABLE  -->

        <div class="formulario__campo">
            <label class="formulario__label" for="FRENO">FRENO</label>
            <input
                type="number"
                name="FRENO"
                id="FRENO"
                class="formulario__input"
                placeholder="FRENO"
                value="<?php echo $papel->FRENO ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="PRESION">PRESION</label>
            <input
                type="number"
                name="PRESION"
                id="PRESION"
                class="formulario__input"
                placeholder="PRESION"
                value="<?php echo $papel->PRESION ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="CUADRE">CUADRE</label>
            <input
                type="number"
                name="CUADRE"
                id="CUADRE"
                class="formulario__input"
                placeholder="CUADRE"
                value="<?php echo $papel->CUADRE ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="PREPRINTER">PREPRINTER</label>
            <input
                type="number"
                name="PREPRINTER"
                id="PREPRINTER"
                class="formulario__input"
                placeholder="PREPRINTER"
                value="<?php echo $papel->PREPRINTER ?? '' ?>">
        </div>

        <!-- MICRO   NO CONTROLABLE  -->
        <div class="formulario__campo">
            <label class="formulario__label" for="mdo">MDO</label>
            <input
                type="number"
                name="mdo"
                id="mdo"
                class="formulario__input"
                placeholder="mdo"
                value="<?php echo $papel->mdo ?? '' ?>">
        </div>



        <!-- FLEXOGRAFICA CONGTROLABLE  -->


        <div class="formulario__campo">
            <label class="formulario__label" for="FALTA_TINTA">FALTA TINTA</label>
            <input
                type="number"
                name="FALTA_TINTA"
                id="FALTA_TINTA"
                class="formulario__input"
                placeholder="FALTA TINTA"
                value="<?php echo $papel->FALTA_TINTA ?? '' ?>">
        </div>


        <div class="formulario__campo">
            <label class="formulario__label" for="MALTRATO_TRASPORT">MALTRATO TRASPORT</label>
            <input
                type="number"
                name="MALTRATO_TRASPORT"
                id="MALTRATO_TRASPORT"
                class="formulario__input"
                placeholder="MALTRATO TRASPORT"
                value="<?php echo $papel->MALTRATO_TRASPORT ?? '' ?>">
        </div>


        <div class="formulario__campo">
            <label class="formulario__label" for="MALTRATO_MONTACARGAS">MALTRATO MONTACARGAS</label>
            <input
                type="number"
                name="MALTRATO_MONTACARGAS"
                id="MALTRATO_MONTACARGAS"
                class="formulario__input"
                placeholder="MALTRATO MONTACARGAS"
                value="<?php echo $papel->MALTRATO_MONTACARGAS ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="TONALIDAD_TINTAS">TONALIDAD TINTAS</label>
            <input
                type="number"
                name="TONALIDAD_TINTAS"
                id="TONALIDAD_TINTAS"
                class="formulario__input"
                placeholder="TONALIDAD TINTAS"
                value="<?php echo $papel->TONALIDAD_TINTAS ?? '' ?>">

        </div>



        <!-- no controlables flexo -->
        <div class="formulario__campo">
            <label class="formulario__label" for="TROQUEL">TROQUEL</label>
            <input
                type="number"
                name="TROQUEL"
                id="TROQUEL"
                class="formulario__input"
                placeholder="TROQUEL"
                value="<?php echo $papel->TROQUEL ?? '' ?>">

        </div>


        <div class="formulario__campo">
            <label class="formulario__label" for="MONTAJE_CLICHE">MONTAJE CLICHE</label>
            <input
                type="number"
                name="MONTAJE_CLICHE"
                id="MONTAJE_CLICHE"
                class="formulario__input"
                placeholder="MONTAJE CLICHE"
                value="<?php echo $papel->MONTAJE_CLICHE ?? '' ?>">
        </div>


        <!-- PRE-PRINTER -->


        <div class="formulario__campo">
            <label class="formulario__label" for="DERRAME_TINTA">DERRAME TINTA</label>
            <input
                type="number"
                name="DERRAME_TINTA"
                id="DERRAME_TINTA"
                class="formulario__input"
                placeholder="DERRAME_TINTA"
                value="<?php echo $papel->DERRAME_TINTA ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="VISCOSIDAD">VISCOSIDAD</label>
            <input
                type="number"
                name="VISCOSIDAD"
                id="VISCOSIDAD"
                class="formulario__input"
                placeholder="VISCOSIDAD"
                value="<?php echo $papel->VISCOSIDAD ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="PH">PH</label>
            <input
                type="number"
                name="PH"
                id="PH"
                class="formulario__input"
                placeholder="PH"
                value="<?php echo $papel->PH ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="APROBACION_COLOR">APROBACION COLOR</label>
            <input
                type="number"
                name="APROBACION_COLOR"
                id="APROBACION_COLOR"
                class="formulario__input"
                placeholder="APROBACION_COLOR"
                value="<?php echo $papel->APROBACION_COLOR ?? '' ?>">
        </div>


        <!-- PRE PRINTER NO CONTROLABLE  -->
        <div class="formulario__campo">
            <label class="formulario__label" for="CIREL_CORTADO">CIREL CORTADO</label>
            <input
                type="number"
                name="CIREL_CORTADO"
                id="CIREL_CORTADO"
                class="formulario__input"
                placeholder="CIREL CORTADO"
                value="<?php echo $papel->CIREL_CORTADO ?? '' ?>">
        </div>

        <!-- DOBLADORA -->

        <div class="formulario__campo">
            <label class="formulario__label" for="MAL_DOBLADO_CEJA">MAL DOBLADO CEJA</label>
            <input
                type="number"
                name="MAL_DOBLADO_CEJA"
                id="MAL_DOBLADO_CEJA"
                class="formulario__input"
                placeholder="MAL DOBLADO CEJA"
                value="<?php echo $papel->MAL_DOBLADO_CEJA ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="EXCESO_GOMA">EXCESO GOMA</label>
            <input
                type="number"
                name="EXCESO_GOMA"
                id="EXCESO_GOMA"
                class="formulario__input"
                placeholder="EXCESO GOMA"
                value="<?php echo $papel->EXCESO_GOMA ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="DESCUADRE_DOBLADO">DESCUADRE DOBLADO</label>
            <input
                type="number"
                name="DESCUADRE_DOBLADO"
                id="DESCUADRE_DOBLADO"
                class="formulario__input"
                placeholder="DESCUADRE DOBLADO"
                value="<?php echo $papel->DESCUADRE_DOBLADO ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="LAM_HUMEDA">LAM HUMEDA</label>
            <input
                type="number"
                name="LAM_HUMEDA"
                id="LAM_HUMEDA"
                class="formulario__input"
                placeholder="LAM HUMEDA"
                value="<?php echo $papel->LAM_HUMEDA ?? '' ?>">
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="LAM_SECA">LAM SECA</label>
            <input
                type="number"
                name="LAM_SECA"
                id="LAM_SECA"
                class="formulario__input"
                placeholder="LAM SECA"
                value="<?php echo $papel->LAM_SECA ?? '' ?>">
        </div>

        <!-- CORTE CEJA  CONTROLABLES-->

        <div class="formulario__campo">
            <label class="formulario__label" for="CUADRE_SIERRA">CUADRE SIERRA</label>
            <input
                type="number"
                name="CUADRE_SIERRA"
                id="CUADRE_SIERRA"
                class="formulario__input"
                placeholder="CUADRE SIERRA"
                value="<?php echo $papel->CUADRE_SIERRA ?? '' ?>">
        </div>


        <!-- TROQUEL NO CONTROLABLES -->

        <div class="formulario__campo">
            <label class="formulario__label" for="MERMA">MERMA</label>
            <input
                type="number"
                name="MERMA"
                id="MERMA"
                class="formulario__input"
                placeholder="MERMA"
                value="<?php echo $papel->MERMA ?? '' ?>">

        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="EXCEDENTES_PLANCHAS">EXCEDENTES PLANCHAS</label>
            <input
                type="number"
                name="EXCEDENTES_PLANCHAS"
                id="EXCEDENTES_PLANCHAS"
                class="formulario__input"
                placeholder="EXCEDENTES_PLANCHAS"
                value="<?php echo $papel->EXCEDENTES_PLANCHAS ?? '' ?>">
        </div>







        <!-- CONTROLABLES CONVERTIDOR  -->

  

        <div class="formulario__campo">
            <label class="formulario__label" for="CAMBIO_MEDIDA">CAMBIO MEDIDA</label>
            <input
                type="number"
                name="CAMBIO_MEDIDA"
                id="CAMBIO_MEDIDA"
                class="formulario__input"
                placeholder="CAMBIO MEDIDA"
                value="<?php echo $papel->CAMBIO_MEDIDA ?? '' ?>">  

    </div>


    <!-- NO CONTROLABLE CONVERTIDOR -->

        <div class="formulario__campo">
            <label class="formulario__label" for="DIFERENCIA_PESO">DIFERENCIA PESO</label>
            <input
                type="number"
                name="DIFERENCIA_PESO"
                id="DIFERENCIA_PESO"
                class="formulario__input"
                placeholder="DIFERENCIA PESO"
                value="<?php echo $papel->DIFERENCIA_PESO ?? '' ?>">
        </div>


        <!-- GUILLOTINA LAMINA -->
        <div class="formulario__campo">
            <label class="formulario__label" for="REFILES">REFILES</label>
            <input
                type="number"
                name="REFILES"
                id="REFILES"
                class="formulario__input"
                placeholder="REFILES"
                value="<?php echo $papel->REFILES ?? '' ?>">
        </div>

        <!-- GUILLOTINA PAPEL -->

        <div class="formulario__campo">
            <label class="formulario__label" for="INICIO_CORRIDA">INICIO CORRIDA</label>
            <input
                type="number"
                name="INICIO_CORRIDA"
                id="INICIO_CORRIDA"
                class="formulario__input"
                placeholder="INICIO CORRIDA"
                value="<?php echo $papel->INICIO_CORRIDA ?? '' ?>">
        </div>

</fieldset>


<script>
    const camposPorMaquinaYClasificacion = {
        'MICRO': {
            'a': ['GALLET', 'COMBADO', 'HUMEDO', 'FRENO', 'DESPE', 'PRESION', 'ERROM', 'SINGLEFACE', 'CUADRE', 'EMPALME', 'RECUB', 'PREPRINTER'], // CONTROLABLE
            'b': ['DESHOJE', 'FILOS_ROTOS', 'ELECTRICO', 'MECANICO', 'PEDIDOS_CORTOS', 'DIFER_ANCHO', 'REFILE_PEQUENO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM', 'SUSTRATO'], // NO CONTROLABLE
        },
        'CORRUGADOR': {
            'a': ['SINGLEFACE', 'EMPALME', 'RECUB', 'GALLET', 'HUMEDO', 'COMBADO', 'DESPE', 'ERROM'],
            'b': ['DESHOJE', 'MECANICO', 'ELECTRICO', 'FILOS_ROTOS', 'REFILE_PEQUENO', 'PEDIDOS_CORTOS', 'DIFER_ANCHO', 'SUSTRATO', 'CAMBIO_GRAMAJE', 'CAMBIO_PEDIDO', 'EXTRA_TRIM'],
        },
        'FLEXOGRAFICA': {
            'a': ['CUADRE', 'FALTA_TINTA', 'MALTRATO_TRASPORT', 'MALTRATO_MONTACARGAS', 'TONALIDAD_TINTAS'],
            'b': ['TROQUEL', 'MONTAJE_CLICHE', 'MECANICO', 'ELECTRICO', 'GALLET', 'COMBADO', 'HUMEDO', 'SUSTRATO', 'DESPE', 'ERROM', 'SUSTRATO'],
        },
        'PREPRINTER': {
            'a': ['FALTA_TINTA', 'DERRAME_TINTA', 'VISCOSIDAD', 'PH', 'CUADRE', 'EMPALME', 'APROBACION_COLOR'],
            'b': ['FILOS_ROTOS', 'CIREL_CORTADO', 'MECANICO', 'ELECTRICO', 'SUSTRATO'],
        },
        'DOBLADO': {
            'a': ['MAL_DOBLADO_CEJA', 'EXCESO_GOMA', 'DESCUADRE_DOBLADO'],
            'b': ['LAM_HUMEDA', 'LAM_SECA'],
        },
        'CORTE CEJA': {
            'a': ['CUADRE_SIERRA'],
            'b': [],
        },
        'TROQUEL': {
            'a': [],
            'b': ['MERMA','COMBADO','EXCEDENTES_PLANCHAS'],
        },
        'CONVERTIDOR': {
            'a': ['CUADRE','CAMBIO_MEDIDA'],
            'b': ['DIFERENCIA_PESO','FILOS_ROTOS'],
        },
        'GUILLOTINA LAMINA': {
            'a': [],
            'b': ['REFILES'],
        },
        'GUILLOTINA PAPEL': {
            'a': [],
            'b': ['INICIO_CORRIDA'],
        },
        'EMPAQUE': {
            'a': [],
            'b': ['GALLET', 'COMBADO', 'HUMEDO', 'FRENO', 'DESPE','PRESION','ERROM','CUADRE','RECUB','FALTA_TINTA','DERRAME_TINTA','SUSTRATO','MAL_DOBLADO_CEJA','EXCESO_GOMA','CUADRE_SIERRA'],
        },
        

        
        




    };

    const todosLosCampos = [
        'SINGLEFACE', 'EMPALME', 'RECUB', 'GALLET', 'HUMEDO', 'COMBADO', 'DESPE', 'ERROM',
        'DESHOJE', 'MECANICO', 'ELECTRICO', 'FILOS_ROTOS', 'REFILE_PEQUENO', 'PEDIDOS_CORTOS',
        'DIFER_ANCHO', 'SUSTRATO', 'CAMBIO_GRAMAJE', 'CAMBIO_PEDIDO', 'EXTRA_TRIM', 'FRENO',
        'PRESION', 'CUADRE', 'PREPRINTER', 'FALTA_TINTA', 'MALTRATO_TRASPORT',
        'MALTRATO_MONTACARGAS', 'TONALIDAD_TINTAS', 'TROQUEL', 'MONTAJE_CLICHE',
        'DERRAME_TINTA', 'VISCOSIDAD', 'PH', 'APROBACION_COLOR', 'CIREL_CORTADO',
        'MAL_DOBLADO_CEJA', 'EXCESO_GOMA', 'DESCUADRE_DOBLADO', 'LAM_HUMEDA', 'LAM_SECA',
        'CUADRE_SIERRA', 'MERMA', 'EXCEDENTES_PLANCHAS', 'CAMBIO_MEDIDA','DIFERENCIA_PESO',
        'REFILES', 'INICIO_CORRIDA',
        'hola', 'mdo'
    ];

    function ocultarYLimpiarTodosLosCampos() {
        todosLosCampos.forEach(id => {
            const input = document.getElementById(id);
            const campo = input?.closest('.formulario__campo');
            if (campo) campo.style.display = 'none';
            if (input) input.value = '';
        });
    }

    function resetearCheckboxes() {
        document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
            chk.checked = false;
        });
        actualizarTipoClasificacion();
    }

    function mostrarCamposSegunSeleccion() {
        const tipoMaquina = document.getElementById('tipo_maquina').value;
        const clasificaciones = document.querySelectorAll('input[name="MDO[]"]:checked');

        clasificaciones.forEach(chk => {
            const clasificacion = chk.value;
            const campos = camposPorMaquinaYClasificacion[tipoMaquina]?.[clasificacion] || [];
            campos.forEach(id => {
                const campo = document.getElementById(id)?.closest('.formulario__campo');
                if (campo) campo.style.display = '';
            });
        });
    }

    function actualizarTipoClasificacion() {
        const seleccionados = Array.from(document.querySelectorAll('input[name="MDO[]"]:checked')).map(el => {
            return el.value === 'a' ? 'CONTROLABLE' : (el.value === 'b' ? 'NO CONTROLABLE' : '');
        });

        document.getElementById('tipo_clasificacion').value = seleccionados.join(',');
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Inicializar select2
        $('#tipo_maquina').select2({
            placeholder: "-- Selecciona un tipo --",
            allowClear: true,
        });

        // Eventos
        document.getElementById('tipo_maquina').addEventListener('change', () => {
            ocultarYLimpiarTodosLosCampos();
            resetearCheckboxes();
            actualizarTipoClasificacion();
        });

        document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
            chk.addEventListener('change', () => {
                ocultarYLimpiarTodosLosCampos();
                mostrarCamposSegunSeleccion();
                actualizarTipoClasificacion();
            });
        });

        // Inicial
        ocultarYLimpiarTodosLosCampos();
        actualizarTipoClasificacion();
    });
</script>