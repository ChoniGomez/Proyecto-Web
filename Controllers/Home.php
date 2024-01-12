<?php
require_once('Config\App\Controller.php');
class Home extends Controller{
    
    public function __construct(){
        session_start();
        //print_r($_SESSION['activo']);
        if (!empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url."Usuarios");
        }
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, 'index');
    }
}
?>