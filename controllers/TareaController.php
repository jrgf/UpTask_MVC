<?php 

namespace Controllers;

use Model\Proyectos;
use Model\Tareas;

class TareaController{
    public static function index()

    {  
        session_start();
        isAuth();
        $proyectoId = $_GET['url'];
        if(!$proyectoId) header('Location: /dashboard');
        $proyecto = Proyectos::where('url',$proyectoId);
        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /404');
        }
        $tareas = Tareas::belongsTo('proyectoId',$proyecto->id);
        echo json_encode(['tareas'=>$tareas]);
    }
    public static function crear()
    {
    session_start();
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        $proyectoId = $_POST['proyectoId'];
        $proyecto = Proyectos::where('url', $proyectoId);
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            $respuesta = [
            'tipo'=>'error',
            'mensaje'=>'Hubo un error al agregar la tarea'
            ];
            echo json_encode($respuesta);
            return;
        }
            $tarea = new Tareas($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = ['tipo'=>'exito','id'=>$resultado['id'],'mensaje'=>'La tarea se ha guardado correctamente','proyectoId'=>$proyecto->id];
            echo json_encode($respuesta);
            
        
    }
}
    public static function actualizar()
    {
    session_start();
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        $proyecto = Proyectos::where('url', $_POST['proyectoId']);
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            $respuesta = [
            'tipo'=>'error',
            'mensaje'=>'Hubo un error al actualizar la tarea'
            ];
            echo json_encode($respuesta);
            return;}
        $tarea = new Tareas($_POST);
        $tarea->proyectoId = $proyecto->id;
        $resultado = $tarea->guardar();
        if($resultado){
            $respuesta = ['tipo'=>'exito','id'=>$tarea->id,'mensaje'=>'Actualizado Correctamente','proyectoId'=>$proyecto->id];
            echo json_encode(['respuesta'=>$respuesta]);
        }
        
    }
}
    public static function eliminar()
    {
        session_start();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $proyecto = Proyectos::where('url', $_POST['proyectoId']);
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            $respuesta = [
            'tipo'=>'error',
            'mensaje'=>'Hubo un error al actualizar la tarea'
            ];
            echo json_encode($respuesta);
            return;}
            $tarea = new Tareas($_POST);
            $resultado = $tarea->eliminar();
            $resultado = ['resultado'=>$resultado,'mensaje'=>'Eliminado correctamente'];

            echo json_encode(['resultado'=>$resultado]);
        }
    }
}