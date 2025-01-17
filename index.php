<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/includes/app.php';


use MVC\Router;
use Controllers\ApiTest;
use Controllers\ApiPedidos;
use Controllers\Subirexcel;
use Controllers\ApiMaquinas;
use Controllers\ApiProductos;
use Controllers\AreaController;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\PapelController;
use Controllers\ClienteController;
use Controllers\ComercialController;
use Controllers\MaquinaController;
use Controllers\CotizadorController;
use Controllers\ProduccionController;
use Controllers\MateriaPrimaController;
use Controllers\EstadisticaProdController;

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

// API 
$router->get('/admin/api/maquinas', [ApiMaquinas::class, 'api']);
$router->get('/admin/api/test', [ApiTest::class, 'api']);
$router->get('/admin/api/apibobinas', [ApiTest::class, 'apibobinas']);
$router->get('/admin/api/apibobina_externa', [ApiTest::class, 'apibobina_externa']);
$router->get('/admin/api/apibobina_media', [ApiTest::class, 'apibobina_media']);

$router->get('/admin/api/productos', [ApiProductos::class, 'productos']);

$router->get('/admin/api/pedidos', [ApiPedidos::class, 'api']);
$router->get('/admin/api/apipedido2', [ApiPedidos::class, 'apipedido2']);

$router->get('/admin/api/allbobinas', [ApiTest::class, 'allbobinas']);

$router->get('/admin/api/allpedidos', [ApiPedidos::class, 'Allpedidos']);


$router->get('/admin/api/allpedidos2', [ApiPedidos::class, 'Allpedidos2']);


// VENTAS 
$router->get('/admin/api/nombreCliente', [ClienteController::class, 'nombreCliente']);
$router->post('/admin/api/actualizar', [ClienteController::class, 'actualizar']);






// Area de Producción
$router->get('/admin/produccion/index', [ProduccionController::class, 'index']);
$router->get('/admin/produccion/registro_produccion', [ProduccionController::class, 'registro_produccion']);
$router->get('/admin/produccion/cotizador/crear', [CotizadorController::class, 'cotizador']);
$router->get('/admin/produccion/subirexcel/crear', [Subirexcel::class, 'subirexcel']);
$router->post('/admin/produccion/subirexcel/crear', [Subirexcel::class, 'subirexcel']);

// AREA DE ESTADISTICAS DE PRODUCCION
$router->get('/admin/produccion/estadistica/crear', [EstadisticaProdController::class, 'crear']);
$router->get('/admin/produccion/estadistica/tabla', [EstadisticaProdController::class, 'tabla']);
$router->get('/admin/produccion/estadistica/editar', [EstadisticaProdController::class, 'editar']);
$router->get('/admin/produccion/estadistica/graficas', [EstadisticaProdController::class, 'graficas']);

$router->post('/admin/produccion/estadistica/crear', [EstadisticaProdController::class, 'crear']);
$router->post('/admin/produccion/estadistica/editar', [EstadisticaProdController::class, 'editar']);
$router->get('/admin/api/apiestadisticas', [EstadisticaProdController::class, 'apiestadisticas']);


// AREA DE COMERCIAl
// $router->get('/admin/comercial/index', [ComercialController::class, 'index']);
$router->get('/admin/comercial/crear', [ComercialController::class, 'crear']);
$router->post('/admin/comercial/crear', [ComercialController::class, 'crear']);

$router->get('/admin/comercial/tabla', [ComercialController::class, 'tabla']);

$router->get('/admin/comercial/editar', [ComercialController::class, 'editar']);

$router->post('/admin/comercial/editar', [ComercialController::class, 'editar']);





// AREA DE FINANCIERO
$router->get('/admin/financiero/tabla', [ComercialController::class, 'tabla']);
$router->get('/admin/financiero/editar', [ComercialController::class, 'editar']);
$router->post('/admin/financiero/editar', [ComercialController::class, 'editar']);


// Materia Prima Producción
$router->get('/admin/produccion/materia/crear', [MateriaPrimaController::class, 'materia']);
$router->post('/admin/produccion/materia/crear', [MateriaPrimaController::class, 'materia']);
$router->get('/admin/produccion/materia/tabla', [MateriaPrimaController::class, 'tabla']);
$router->get('/admin/produccion/materia/pdf', [MateriaPrimaController::class, 'pdf']);
$router->get('/admin/produccion/materia/editar', [MateriaPrimaController::class, 'editar']);
$router->post('/admin/produccion/materia/editar', [MateriaPrimaController::class, 'editar']);

$router->get('/admin/produccion/materia/lector', [MateriaPrimaController::class, 'lector']);

$router->get('/admin/produccion/materia/graficas', [MateriaPrimaController::class, 'graficas']);

// API MATERIA PRIMA
$router->get('/admin/api/ApiMateriaPrima', [MateriaPrimaController::class, 'ApiMateriaPrima']);












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


// Cliente

$router->get('/admin/vendedor/cliente/crear', [ClienteController::class, 'crear']);
$router->post('/admin/vendedor/cliente/crear', [ClienteController::class, 'crear']);

$router->get('/admin/vendedor/cliente/cotizador', [ClienteController::class, 'cotizador']);
$router->get('/admin/vendedor/cliente/tabla', [ClienteController::class, 'tabla']);
$router->get('/admin/vendedor/cliente/editar', [ClienteController::class, 'editar']);
$router->post('/admin/vendedor/cliente/editar', [ClienteController::class, 'editar']);
$router->post('/admin/vendedor/cliente/eliminar', [ClienteController::class, 'eliminar']);






$router->comprobarRutas();