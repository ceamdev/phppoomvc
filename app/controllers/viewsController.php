<?php
    namespace app\controllers;
    use app\models\viewsModel; // llamamos al modelo que tendras la logica del las views.

    /** creamos la logica de controlador que conectara el modelo con la vista */
    class viewsController extends viewsModel{
        
        /** Esta function se esta accediendo desde el viewModel.php 
         * para controllar las vistas.
        */
        public function getViewsController($view){
            // si viene vacia la vista.
            if ($view!="") {
            // obtenemos la respuesta desde viewModel.php.
                $reponseView=$this->getViewsModel($view);
            }else{
            // si no es una vista enviara a login.
                $reponseView="login";
            }
            return $reponseView;
        }
    }