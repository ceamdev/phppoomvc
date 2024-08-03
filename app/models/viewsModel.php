<?php

    namespace app\models;
    /** Creamos clases que tendrá la logica de control de las vistas (views) del sistema. */
    class viewsModel{
        protected function getViewsModel($view){
            /** lista de palabras que serán permitidas como arrays para cargar las vista, en caso no existir cargara un error 404. */
            $whitelist=["dashboard"];
            /** Comprobamos mediante esta condicional si la vista viene de whitelist. */
            if (in_array($view,$whitelist)) {
                /** verificamos si la ruta de la vista existe mediante is_file() */
                if(is_file("./app/views/content/".$view."-view.php")){
                    // si existe cargamos la vista.
                    $contentView ="./app/views/content/".$view."-view.php";
                }else{
                    // sino existe cargamos la vista error 404.
                    $contentView = "404";
                }
            /** En caso de que la primera condicion in_array() no se cumpla entrara en esta otra condicion
             * donde cargará la vista login o index según sea el caso login.
             */
            }elseif($view == "login" || $view=="index"){
                $contentView = "login"; // cagará para loguearse.
            }else{
            // De no cumplirse las 2 condiciones enviara a 404 porque la vista no existe.
                $contentView = "404";
            }
            return $contentView;
        }
    }