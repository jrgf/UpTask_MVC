<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashBoardController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\TareaController;

$router = new Router();


$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);
//Rutas para crear cuentas
$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);

//Rutas para recuperar cuenta
$router->get('/recuperar-cuenta',[LoginController::class,'recuperar']);
$router->post('/recuperar-cuenta',[LoginController::class,'recuperar']);
//Rutas para restablecer password
$router->get('/restablecer',[LoginController::class,'restablecer']);
$router->post('/restablecer',[LoginController::class,'restablecer']);
//Rutas de confirmación de cuenta
$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);

//Rutas de PROYECTOS
$router->get('/dashboard',[DashBoardController::class,'index']);
$router->get('/crear-proyecto',[DashBoardController::class,'crear_proyecto']);
$router->post('/crear-proyecto',[DashBoardController::class,'crear_proyecto']);
$router->get('/proyecto',[DashBoardController::class,'proyecto']);
$router->post('/proyecto',[DashBoardController::class,'proyecto']);
$router->get('/perfil',[DashBoardController::class,'perfil']);
$router->post('/perfil',[DashBoardController::class,'perfil']);
$router->get('/cambiar-password',[DashBoardController::class,'cambiar_password']);
$router->post('/cambiar-password',[DashBoardController::class,'cambiar_password']);
//API para las tareas
$router->get('/api/tareas',[TareaController::class,'index']);
$router->post('/api/tarea',[TareaController::class,'crear']);
$router->post('/api/tarea/actualizar',[TareaController::class,'actualizar']);
$router->post('/api/tarea/eliminar',[TareaController::class,'eliminar']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
