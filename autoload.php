<?php
/** Obtenemos los nombres de las clases (class) o archivos del sistemas. */
//echo __DIR__; // para visualizar directorio mediante ruta absoluta,
spl_autoload_register(function($class){
    // Obtenemos la ruta absoluta mediante __DIR__ de la class que será autocargada por el autoload.php.
        $PATH=__DIR__."/".$class.".php";
    /** En caso de SO del Server sea distinto de Windows,
     *  las / seria \ inversa hay que cambiarlas a / para ellos se usa */
        $PATH=str_replace("\\","/",$PATH); // con esto cambiamos la \ por / (en caso del ser el servidor distinto de Windows).

    /** Validamos que los archivos $file exitan, en caso contrario mostrar un error. */
        if (is_file($PATH)) {
         // si existe lo cargara.
            require_once $PATH;
        }else {
        // en caso contrario mostrará este error.
        return "No existe".$PATH;
    }
});