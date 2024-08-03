<?php
/** Cargamos la configuraciones de conexion y demas del sistema. */
require_once("./config/app.php");
/** Requerimos el uso de autoload.php para que cargue automaticamente los archivos de las clases del sistema */
require_once("./autoload.php");
/** Requerimos el uso de session start para abrir session dentro del dashboard o seccion privada */
require_once("./app/views/inc/sessionstart.php");

/** Llamamos a la URL (route) de las vista. */
    if(isset($_GET['views'])){
        // Creamos la ruta de la view.
        $ROUTE=explode("/",$_GET['views']); // explode (separa en arrays la ruta, separandola con el "/")
    }else{ 
        // Redireccionamos si no existe la ruta de la view.
        $ROUTE=['login']; // redireccinamos a login o otra vista en caso de que no exista.
    }
?>
<p></p>
<?php

/** Cargamos el Layouts predefinido. */

/** Head, header y sliders */
include("./app/views/inc/head.php");

/** Llamando a as vistas de viewsModel y viewsController */
    use app\controllers\viewsController;
    $viewsController=new viewsController();
    $view = $viewsController->getViewsController($ROUTE[0]);

    if($view=="login" || $view == "404"){
        require_once "./app/views/content/".$view."-view.php";
    }else {
        require_once $view;
    }

    
/** Footer, links y tos. */
include("./app/views/inc/footer.php");
?>

