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
use Controllers\EstimarController;
use Controllers\MaquinaController;
use Controllers\CartoneraController;
use Controllers\ComercialController;
use Controllers\CotizadorController;
use Controllers\PlanificoController;
use Controllers\FinancieroController;
use Controllers\ProduccionController;
use Controllers\MateriaPrimaController;
use Controllers\EstadisticaProdController;
use Controllers\SistemasController;
use Model\MateriaPrima;

$router = new Router();


// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
// $router->post('/registro', [AuthController::class, 'registro']);

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

$router->get('/admin/comercial/excel', [ComercialController::class, 'excel']);
$router->post('/admin/comercial/excel', [ComercialController::class, 'excel']);


$router->get('/admin/comercial/subirexcelreclamos', [ComercialController::class, 'subirexcelreclamos']);
$router->post('/admin/comercial/subirexcelreclamos', [ComercialController::class, 'subirexcelreclamos']);

// Api Comercial
$router->get('/admin/api/apicomercial', [ComercialController::class, 'apicomercial']);

$router->get('/admin/comercial/pdfquejas', [ComercialController::class, 'pdfquejas']);




// AREA DE FINANCIERO
$router->get('/admin/financiero/tabla', [FinancieroController::class, 'tabla']);
$router->get('/admin/financiero/editar', [FinancieroController::class, 'editar']);
$router->post('/admin/financiero/editar', [FinancieroController::class, 'editar']);









// Materia Prima Producción
$router->get('/admin/produccion/materia/crear', [MateriaPrimaController::class, 'materia']);
$router->post('/admin/produccion/materia/crear', [MateriaPrimaController::class, 'materia']);
$router->get('/admin/produccion/materia/tabla', [MateriaPrimaController::class, 'tabla']);
$router->get('/admin/produccion/materia/pdf', [MateriaPrimaController::class, 'pdf']);
$router->get('/admin/produccion/materia/editar', [MateriaPrimaController::class, 'editar']);
$router->post('/admin/produccion/materia/editar', [MateriaPrimaController::class, 'editar']);

$router->get('/admin/produccion/materia/lector', [MateriaPrimaController::class, 'lector']);

$router->get('/admin/produccion/materia/graficas', [MateriaPrimaController::class, 'graficas']);


$router->get('/admin/produccion/materia/excel', [MateriaPrimaController::class, 'excel']);
$router->post('/admin/produccion/materia/excel', [MateriaPrimaController::class, 'excel']);






// CORRUGADOR 
$router->get('/admin/produccion/materia/corrugador', [MateriaPrimaController::class, 'corrugador']);
$router->post('/admin/produccion/materia/corrugador', [MateriaPrimaController::class, 'corrugador']);

// CORRUGADOR VENTANA
$router->get('/admin/produccion/materia/corrugadorVentana', [MateriaPrimaController::class, 'corrugadorVentana']);
// EXCEL NUEVO DE PROYECCIONES 
$router->get('/admin/produccion/materia/excelNuevo', [MateriaPrimaController::class, 'excelNuevo']);
$router->post('/admin/produccion/materia/excelNuevo', [MateriaPrimaController::class, 'excelNuevo']);

// API PROYECCIONES 
$router->get('/admin/api/apiproyecciones', [MateriaPrimaController::class, 'apiproyecciones']);

// eliminar base 
$router->post('/admin/produccion/materia/eliminarTabla', [MateriaPrimaController::class, 'eliminarTabla']);


// CARPETA CORRUGADOR EXISTENCIA 
$router->get('/admin/produccion/materia/corrugador/cajacraft', [MateriaPrimaController::class, 'cajacraft']);
$router->get('/admin/produccion/materia/corrugador/cajablanco', [MateriaPrimaController::class, 'cajablanco']);
$router->get('/admin/produccion/materia/corrugador/cajamedium', [MateriaPrimaController::class, 'cajamedium']);

// CARPEATA CORRUGADOR IMPORTACIONES

$router->get('/admin/produccion/materia/corrugador/cajakraftimport', [MateriaPrimaController::class, 'cajakraftimport']);




// CARPETA MICRO CORRUGADOR EXISTENCIA





// CARPETA PERIODICO EXISTENCIA 

// API CORRUGADOR 
$router->get('/admin/api/apicorrugador', [MateriaPrimaController::class, 'apicorrugador']);
$router->get('/admin/api/apicorrugador2', [MateriaPrimaController::class, 'apicorrugador2']);
$router->get('/admin/api/apiAnchossobrantes', [MateriaPrimaController::class, 'apiAnchossobrantes']);
$router->get('/admin/api/apicajacraft', [MateriaPrimaController::class, 'apicajacraft']);
$router->get('/admin/api/apicajablanco', [MateriaPrimaController::class, 'apicajablanco']);
$router->get('/admin/api/apicajamedium', [MateriaPrimaController::class, 'apicajamedium']);

$router->get('/admin/api/apicajakraftimport', [MateriaPrimaController::class, 'apicajakraftimport']);

// MICROCORRUGADOR
$router->get('/admin/produccion/materia/microcorrugador', [MateriaPrimaController::class, 'microcorrugador']);


// PERIODICO
$router->get('/admin/produccion/materia/periodico', [MateriaPrimaController::class, 'periodico']);



// API MATERIA PRIMA
$router->get('/admin/api/ApiMateriaPrima', [MateriaPrimaController::class, 'ApiMateriaPrima']);







// Maquinas
$router->get('/admin/produccion/maquinas/tabla', [MaquinaController::class, 'tabla']);
$router->get('/admin/produccion/maquinas/crear', [MaquinaController::class, 'crear']);
$router->post('/admin/produccion/maquinas/crear', [MaquinaController::class, 'crear']);
$router->get('/admin/produccion/maquinas/editar', [MaquinaController::class, 'editar']);
$router->post('/admin/produccion/maquinas/editar', [MaquinaController::class, 'editar']);
$router->post('/admin/produccion/maquinas/eliminar', [MaquinaController::class, 'eliminar']);





// TABLAS PAPEL 

$router->get('/admin/produccion/papel/tabla', [PapelController::class, 'tabla']);
$router->get('/admin/produccion/papel/tabla_convertidor', [PapelController::class, 'tabla_convertidor']);
$router->get('/admin/produccion/papel/tabla_corte_ceja', [PapelController::class, 'tabla_corte_ceja']);
$router->get('/admin/produccion/papel/tabla_doblado', [PapelController::class, 'tabla_doblado']);
$router->get('/admin/produccion/papel/tabla_flexografica', [PapelController::class, 'tabla_flexografica']);
$router->get('/admin/produccion/papel/tabla_preprinter', [PapelController::class, 'tabla_preprinter']);
$router->get('/admin/produccion/papel/tabla_troquel', [PapelController::class, 'tabla_troquel']);
$router->get('/admin/produccion/papel/tabla_guillotina_lamina', [PapelController::class, 'tabla_guillotina_lamina']);
$router->get('/admin/produccion/papel/tabla_guillotina_papel', [PapelController::class, 'tabla_guillotina_papel']);
$router->get('/admin/produccion/papel/tabla_micro', [PapelController::class, 'tabla_micro']);
$router->get('/admin/produccion/papel/tabla_empaque', [PapelController::class, 'tabla_empaque']);




// AREA DE CONSUMO DE PAPEL POR ID ORDEN
$router->get('/admin/produccion/papel/ingresoConsumo', [PapelController::class, 'ingresoConsumo']);
$router->post('/admin/produccion/papel/ingresoConsumo', [PapelController::class, 'ingresoConsumo']);

// Editar PAPEL
$router->get('/admin/produccion/papel/editar_convertidor', [PapelController::class, 'editar_convertidor']);


// papel
$router->get('/admin/produccion/papel/crear', [PapelController::class, 'crear']);
$router->post('/admin/produccion/papel/crear', [PapelController::class, 'crear']);
$router->get('/admin/produccion/papel/editar', [PapelController::class, 'editar']);
$router->post('/admin/produccion/papel/editar', [PapelController::class, 'editar']);
$router->post('/admin/produccion/papel/eliminar', [PapelController::class, 'eliminar']);

// API PAPEL
$router->get('/admin/api/apidesperdiciopapel', [PapelController::class, 'apidesperdiciopapel']);




// API LISTA DE PAPELES
$router->get('/admin/api/apipapel', [CartoneraController::class, 'apipapel']);


// VER PAPEL Y ESTADISTICAS

$router->get('/admin/produccion/papel/graficos', [PapelController::class, 'graficos']);






// Cliente

$router->get('/admin/vendedor/cliente/crear', [ClienteController::class, 'crear']);
$router->post('/admin/vendedor/cliente/crear', [ClienteController::class, 'crear']);

$router->get('/admin/vendedor/cliente/cotizador', [ClienteController::class, 'cotizador']);
$router->get('/admin/vendedor/cliente/tabla', [ClienteController::class, 'tabla']);
$router->get('/admin/vendedor/cliente/editar', [ClienteController::class, 'editar']);
$router->post('/admin/vendedor/cliente/editar', [ClienteController::class, 'editar']);
$router->post('/admin/vendedor/cliente/eliminar', [ClienteController::class, 'eliminar']);


// planifico de byron 

$router->get('/admin/produccion/planificacion/index', [PlanificoController::class, 'index']);


// TRIMAR PEDIDOS CON DUPLAS 
$router->get('/admin/produccion/materia/corrugador/cartonera/index', [CartoneraController::class, 'cartonera']); 
$router->get('/admin/produccion/materia/corrugador/cartonera/pedidoseleccionados', [CartoneraController::class, 'pedidoseleccionados']);

$router->get('/admin/produccion/materia/corrugador/cartonera/dupla', [CartoneraController::class, 'dupla']);


$router->get('/admin/produccion/materia/corrugador/cartonera/combinacion', [CartoneraController::class, 'combinacion']);











// COTIZADOR FABIAN 
$router->get('/admin/produccion/estimar/index', [EstimarController::class, 'index']);
$router->get('/admin/produccion/estimar/micro', [EstimarController::class, 'micro']);
$router->get('/admin/produccion/estimar/cajas', [EstimarController::class, 'cajas']);
$router->get('/admin/produccion/estimar/separadores', [EstimarController::class, 'separadores']);
$router->get('/admin/produccion/estimar/costos_generales/index', [EstimarController::class, 'costos_generales']);

// error 404
$router->get('/admin/error404', [AdminController::class, 'error404']);



// API TRIMAR   
$router->get('/admin/api/trimar', [CotizadorController::class, 'trimar']);


$router->get('/admin/produccion/cotizador/trimarp', [CotizadorController::class, 'trimarp']);
$router->post('/admin/produccion/cotizador/trimarp', [CotizadorController::class, 'trimarp']);




// AREA DE SISTEMA DE INVENTARIO DE PRODUCTOS DE INFORMATICA
$router->get('/admin/sistemas/index', [SistemasController::class, 'index']);
$router->get('/admin/sistemas/productos/crear', [SistemasController::class, 'crear']);
$router->post('/admin/sistemas/productos/crear', [SistemasController::class, 'crear']);


$router->get('/admin/sistemas/movimiento/movimientos', [SistemasController::class, 'movimientos']);
$router->post('/admin/sistemas/movimiento/movimientos', [SistemasController::class, 'movimientos']);
$router->get('/admin/sistemas/solicitudes/solicitud', [SistemasController::class, 'solicitud']);
$router->post('/admin/sistemas/solicitudes/solicitud', [SistemasController::class, 'solicitud']);


$router->get('/admin/sistemas/solicitudes/tabla', [SistemasController::class, 'tabla']);

$router->get('/admin/sistemas/solicitudes/pdf', [SistemasController::class, 'pdf']);
$router->get('/admin/sistemas/solicitudes/pdfcompraryfinaciero', [SistemasController::class, 'pdfcompraryfinaciero']);





// api de movimientos
$router->get('/admin/api/apimovimientos', [SistemasController::class, 'apimovimientos']);
$router->get('/admin/api/apiproducts', [SistemasController::class, 'apiproducts']);


$router->get('/admin/sistemas/pdfinventario', [SistemasController::class, 'pdfinventario']);


$router->get('/admin/sistemas/registropc/version', [SistemasController::class, 'version']);
$router->post('/admin/sistemas/registropc/version', [SistemasController::class, 'version']);
// api de computadoras

$router->get('/admin/api/apicomputadoras', [SistemasController::class, 'apicomputadoras']);


$router->get('/admin/sistemas/registropc/ver', [SistemasController::class, 'ver']);
$router->post('/admin/sistemas/registropc/ver', [SistemasController::class, 'ver']);



// generar ticket de soporte
$router->get('/admin/sistemas/ticket/crearTicket', [SistemasController::class, 'crearTicket']);
$router->post('/admin/sistemas/ticket/crearTicket', [SistemasController::class, 'crearTicket']);


$router->get('/admin/sistemas/ticket/tablaTicket', [SistemasController::class, 'tablaTicket']);


$router->get('/admin/sistemas/ticket/vistaTicket', [SistemasController::class, 'vistaTicket']);

$router->get('/admin/sistemas/ticket/editarTicket', [SistemasController::class, 'editarTicket']);
$router->post('/admin/sistemas/ticket/editarTicket', [SistemasController::class, 'editarTicket']);

$router->get('/admin/sistemas/ticket/calificar', [SistemasController::class, 'calificar']);
$router->post('/admin/sistemas/ticket/calificar', [SistemasController::class, 'calificar']);

// api de ticket
$router->get('/admin/api/apiticket', [SistemasController::class, 'apiticket']);




// api materia prima
$router->get('/admin/api/apimateriaprimajson', [MateriaPrimaController::class, 'apimateriaprimajson']);




// citas de prueba 

$router->get('/admin/api/citas', [EstimarController::class, 'citas']);

$router->comprobarRutas();