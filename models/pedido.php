<?php

class pedido{
    private $id;
    private $folio;
    private $fecha;
    private $proveedor_id;
    private $descripcion;
    private $db;
    
    public function __construct() {
            $this->db = Database::connection();
    }
    
    function getId() {
        return $this->id;
    }

    function getFolio() {
        return $this->folio;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getProveedor_id() {
        return $this->proveedor_id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setFolio($folio): void {
        $this->folio = $folio;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function setProveedor_id($proveedor_id): void {
        $this->proveedor_id = $proveedor_id;
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }
    
    function makeOrder(){
        $resultOrder = false;
        $sql = "INSERT INTO pedido (id, folio, fecha, proveedor_id) VALUES (NULL, 'GAT123', NOW(), {$this->getProveedor_id()});";
        $query = $this->db->query($sql) or die ('Error en el query database: ' .mysqli_error($this->db));
        //Devuelve el último registro
        if($query){
            $last_id = $this->db->insert_id;
            $sql = "SELECT id, folio, fecha FROM pedido WHERE id={$last_id};";
            $querySelect = $this->db->query($sql) or die('Error en el query database: ' .mysqli_error($this->db));
            $resultOrder = $querySelect->fetch_object();
            //$result = $last_id;
            //Es conveniente que regrese también una consulta con los datos del pedido
        }
        return $resultOrder;
    }
    

    
}
    
    
