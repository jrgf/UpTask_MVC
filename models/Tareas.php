<?php 

namespace Model;

class Tareas extends ActiveRecord{
    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id','nombre','Estado','proyectoId'];

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->Estado = $args['Estado'] ?? 0;
        $this->proyectoId = $args['proyectoId'] ?? '';
    }
}