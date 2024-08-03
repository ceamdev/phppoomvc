<?php 

namespace app\models;
use \PDO;
use \PDOException;

    /** validamos si el archivo server existe para conectarse a la BD */
    if (file_exists(__DIR__."/../../config/server.php")) {
        /** si el archivo exite lo incluimos con require_once */
        require_once __DIR__."/../../config/server.php";
    }else {
        echo "Debe configurar credenciales del conexión a Base de datos";
    }

    /** se creará el modelo principal que serán funciones que se podrán reutilizar. */
    class mainModel{
        private $server=DB_SERVER;
        private $db=DB_NAME;
        private $user=DB_USER;
        private $pass=DB_PASS;

        /** metodo de conexion a la base de datos usando PDO. y Try and Catch para manejo de errores. */
        protected function connectDataBase(){
            try {
                $connect = new PDO("mysql:host=".$this->server.";dbname=".$this->db."", $this->user, $this->pass);
                $connect->exec("SET CHARACTER SET UTF8");
                return $connect;
            // incluimos excepciones si ocurre un error.
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        /** consultamos a la base de datos. */
        protected function runQuery($query){
            $sql=$this->connectDataBase()->prepare($query);
            $sql->execute();
            return $sql;
        }

        /** para evitar las inyecciones de codigo, limpiamos las consultas cleanQuerys, de las palabras (words) 
         * antes de ingresarlos datos de la cadena (chain)
         * que se ingresarán a la db */
		public function cleanQuerys($chain){
            // no se permitiran las siguientes palabras para evitar la inyeccion de sentencias SQL o inyección de codigo.
			$words=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];
            // con trim (eliminamos espacios en blanco antes y despues de las cadenas (chain).
			$chain=trim($chain);
            // con stripslashes elimina los / \ de las cadenas de texto.
			$chain=stripslashes($chain);

            // aca con este foreache recorremos todo el array words y sustituimos con str_ireplace a "" (vacio).
			foreach($words as $word){
				$chain=str_ireplace($word, "", $chain);
			}
			$chain=trim($chain);
			$chain=stripslashes($chain);

			return $chain;
		}

        /**
         * Modelo para validar formularios mediante expresiones regulares, con la funcion verifyData().
         */
        protected function verifyData($pattern,$chain){
            /* valida que se cumpla la comparación entre lo que se introduce en el campo input 
             * de los formularios y la expresión regular establecida. */
            if (preg_match("/^".$pattern."$/", $chain)) {
                return false;
            }else {
                return true;
            }
        }

        /** Modelo para guadar datos en cualquier tabla de la base de datos. */
        protected function saveData($table,$datas){
            // iniciamos contrucción de Query SQL.
			$query="INSERT INTO $table (";
            // contruimos y anexamos , para separa cada campos dentro de la sentencia.
            // inicializamos nuevamente el contador para recorrer los datos desde cero.
			$Counter=0;
            // recorremos los campos, si existe más e 1 campo, le anexada una (,) coma para separarlos.
			foreach ($datas as $key){
				if($Counter>=1){ $query.=","; }
				$query.=$key["field_name"];
				$Counter++;
			}
			// cerramoslos campos de la tabla y ahora recorremos los valores (VALUES) a insertar.
			$query.=") VALUES(";
            // inicializamos nuevamente el contador para recorrer los datos desde cero.
			$Counter=0;
            // ahora recorremos los registros, si existe más de 1 registro, le anexada una (,) coma para separarlos, según los campos,
			foreach ($datas as $key){
				if($Counter>=1){ $query.=","; }
				$query.=$key["field_marker"];
				$Counter++;
			}
            // cerramos la sentencia SQL.
			$query.=")";
            // conectamos y preparamos la Query. https://www.php.net/manual/es/pdo.prepare.php
			$sql=$this->connectDataBase()->prepare($query);
            // recorremos los datos reales a insertar y los pasamos de marcadores a datos de inserción.
			foreach ($datas as $key){
                // https://www.php.net/manual/es/pdostatement.bindparam.php
				$sql->bindParam($key["field_marker"],$key["field_value"]);
			}
            // ejecutamos la query para insertar. https://www.php.net/manual/es/pdostatement.execute.php
			$sql->execute();
            // retornamos.
			return $sql;
		}

    }