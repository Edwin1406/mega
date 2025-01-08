<?php

namespace Controllers;

use MVC\Router;

class EstadisticaProdController {
    public function crear(Router $router)
    {
        $router->render('admin/produccion/estadistica/crear', [
            'titulo' => 'Estadísticas de Producción',
        ]);      
}}