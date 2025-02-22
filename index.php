<?php
    // para incluir el estilo de los archivos js y css
    require_once "Config/Config.php";
    $ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
    $array = explode("/", $ruta);
    $controller = $array[0];
    $metodo = "index";
    $parametro = "";
    if(!empty($array[1])){
        if(!empty($array[1]) != ""){
            $metodo = $array[1];
        }
    }
    if(!empty($array[2])){
        if(!empty($array[2]) != ""){
            for ($i=2; $i < count($array); $i++) { 
                $parametro .=$array[$i]. ",";
            }
            // para eliminar la coma al final
            $parametro = trim($parametro, ",");
        }
    }
    require_once "Config/App/autoload.php";
    $dirControllers = "Controllers/".$controller.".php";
    if (file_exists($dirControllers)) {
        require_once $dirControllers;
        $controller = new $controller();
        // consulto si existe un metodo dentro del controlador
        if (method_exists($controller, $metodo)) {
            $controller->$metodo($parametro);
        }else{
            header('Location: '.base_url.'Errores');
        }
    }else{
        header('Location: '.base_url.'Errores');
    }
    
?>