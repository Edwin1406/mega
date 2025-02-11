<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $url_actual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];   
    
        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }
    
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            // Evitar redirección infinita si ya estamos en la página de error
            if ($url_actual !== '/views/admin/error404/404') {
                http_response_code(404);  // Enviar código de respuesta 404
                header('Location: /views/admin/error404/404');  // Redirigir a la página de error
                exit();  // Detener la ejecución
            } else {
                echo 'Error 404: Página no encontrada';  // Muestra un mensaje simple si ya estamos en la página de error
            }
        }
    }

    public function render(string $view, array $datos = []): void
    {
        extract($datos, EXTR_SKIP);

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();


        $url_actual = $_SERVER['REQUEST_URI'] ?? '/';
        
       
        // debuguear($url_actual);

        if(str_contains($url_actual,'/admin')){
            include __DIR__ . "/views/admin-layout.php";

        }else{
            
            include __DIR__ . "/views/layout.php";

        }
      

       
    }
}
