<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/includes/app.php';


use MVC\Router;
use Controllers\AreaController;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\PapelController;
use Controllers\MaquinaController;
use Controllers\ProduccionController;

$router = new Router();


// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


// Area de Administración

$router->get('/admin/index', [AdminController::class, 'index']);

$router->get('/admin/area', [AreaController::class, 'index']);
$router->get('/admin/area/crear', [AreaController::class, 'crear']);
$router->post('/admin/area/crear', [AreaController::class, 'crear']);
$router->get('/admin/area/paginaArea', [AreaController::class, 'paginaArea']);

$router->get('/admin/area/escoger', [AreaController::class, 'escoger']);


// Area de Producción
$router->get('/admin/produccion/index', [ProduccionController::class, 'index']);
$router->get('/admin/produccion/registro_produccion', [ProduccionController::class, 'registro_produccion']);
$router->get('/admin/produccion/cotizador/index', [ProduccionController::class, 'cotizador']);

// Maquinas
$router->get('/admin/produccion/maquinas/tabla', [MaquinaController::class, 'tabla']);
$router->get('/admin/produccion/maquinas/crear', [MaquinaController::class, 'crear']);
$router->post('/admin/produccion/maquinas/crear', [MaquinaController::class, 'crear']);
$router->get('/admin/produccion/maquinas/editar', [MaquinaController::class, 'editar']);
$router->post('/admin/produccion/maquinas/editar', [MaquinaController::class, 'editar']);
$router->post('/admin/produccion/maquinas/eliminar', [MaquinaController::class, 'eliminar']);






// papel
$router->get('/admin/produccion/papel/tabla', [PapelController::class, 'tabla']);
$router->get('/admin/produccion/papel/crear', [PapelController::class, 'crear']);
$router->post('/admin/produccion/papel/crear', [PapelController::class, 'crear']);
$router->get('/admin/produccion/papel/editar', [PapelController::class, 'editar']);
$router->post('/admin/produccion/papel/editar', [PapelController::class, 'editar']);
$router->post('/admin/produccion/papel/eliminar', [PapelController::class, 'eliminar']);




$router->comprobarRutas();