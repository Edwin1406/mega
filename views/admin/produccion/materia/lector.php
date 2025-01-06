<script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
  <style>
      h1 {
      color: #007bff;
    }
  
#scanner img, #scanner video {
    width: 100%;
    height: auto;
    margin-top: 10rem;
    border-radius: 1rem;
    
} 
.contenedor {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    #status {
      font-weight: bold;
      margin: 10px 0;
      font-size: 3rem;
    }
    #notificacion {
      position: fixed;
      bottom: -100px; /* Oculta la notificación inicialmente */
      left: 50%;
      transform: translateX(-50%);
      background-color: #007bff;
      color: white;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      font-size: 16px;
      z-index: 1000;
      transition: bottom 0.5s ease-in-out;
    }
    #notificacion.mostrar {
      bottom: 20px; /* Muestra la notificación */
    }
  </style>

<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<div class="contenedor">
    <p id="status">Escaneando...</p>
    <div id="scanner">
    </div>
    <div id="notificacion"></div>
</div>


