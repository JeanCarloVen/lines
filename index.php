<?php
//obs_start();
/*Controlador Fronta1l*/
require_once 'autoload.php'; // Funcion que cargará las clases necesarias.
require_once 'config/db.php'; // Clase que permite establecer la conexión con el servidor.
require_once 'config/parameters.php'; // Definimos constantes.
require_once 'helpers/utils.php'; // Funciones utiles

session_start();

require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';

/*-- Body --*/

// Se muestra la pagina de error
function show_error(){
    $error = new errorController;
    $error->index();
}

// Comprobamos que llegue la variable por URL
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
    
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
}
else{
    show_error();
    exit();
}    

/*Comprobamos que exista el controlador*/
if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador; /*Se crea el objeto de la clase*/
    
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador -> $action();

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $default = action_default;
        $controlador->$default();
        
    }else{
        show_error();
    }
} else {
    show_error();
}

?>