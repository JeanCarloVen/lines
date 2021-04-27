<?php
class Database{
    public static function connection() {
        $db = new mysqli('localhost','root','', 'db_lines'); // Instanciamos la consulta para la conexion
        $db->query("SET NAMES 'utf8'"); // Realizamos la consulta estableciendo utf8
        return $db; //regresa el valor de la consulta (true o false)
    }
}


?>