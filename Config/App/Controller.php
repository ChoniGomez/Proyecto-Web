<?php
require_once('Config\App\Views.php');
class Controller{
    //codigo nuevo
    protected $views, $model;
    public function __construct(){
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel(){
        $model = get_class($this)."Model";
        $ruta = "Models/".$model.".php";
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model= new $model();
        }
    }
}
?>