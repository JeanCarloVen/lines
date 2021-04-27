<?php

class servicio{
    private $id;
    private $proveedor_id;
    private $status;
    private $SKU;
    private $descripcion;
    private $precio_unitario;
    private $comision_menudeo;
    private $db;
    
    public function __construct() {
        $this->db = Database::connection();
    }
    
    function getId() {
        return $this->id;
    }

    function getProveedor_id() {
        return $this->proveedor_id;
    }

    function getStatus() {
        return $this->status;
    }

    function getSKU() {
        return $this->SKU;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio_unitario() {
        return $this->precio_unitario;
    }

    function getComision_menudeo() {
        return $this->comision_menudeo;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setProveedor_id($proveedor_id): void {
        $this->proveedor_id = $proveedor_id;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setSKU($SKU): void {
        $this->SKU = $SKU;
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    function setPrecio_unitario($precio_unitario): void {
        $this->precio_unitario = $precio_unitario;
    }

    function setComision_menudeo($comision_menudeo): void {
        $this->comision_menudeo = $comision_menudeo;
    }
    
    function setServicios(){
        $result = false;
        $sql = "INSERT INTO servicio (id, proveedor_id, status, SKU, descripcion, precio_unitario, comision_menudeo) Values (NULL, {$this->getProveedor_id()}, '{$this->getStatus()}','{$this->getSKU()}', '{$this->getDescripcion()}', {$this->getPrecio_unitario()}, {$this->getComision_menudeo()});";
        $query = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        if($query){
            $result = true;
        }
        return $result;
    }
    
    function getAllServices(){
        $sql = "SELECT * FROM servicio WHERE proveedor_id={$this->getProveedor_id()}";
        $servicios = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        return $servicios;
    }


}


?>
