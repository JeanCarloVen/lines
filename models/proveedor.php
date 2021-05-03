<?php

class proveedor{
    
    private $id;
    private $nombre;
    private $rfc;
    private $correo;
    private $telefono;
    private $calle_numero;
    private $colonia;
    private $municipio;
    private $codigo_postal;
    private $estado;
    private $ubicación_maps;
    private $db;
    
    public function __construct() {
        $this->db = Database::connection();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRfc() {
        return $this->rfc;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCalle_numero() {
        return $this->calle_numero;
    }

    function getColonia() {
        return $this->colonia;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getCodigo_postal() {
        return $this->codigo_postal;
    }

    function getEstado() {
        return $this->estado;
    }

    function getUbicación_maps() {
        return $this->ubicación_maps;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setRfc($rfc): void {
        $this->rfc = $rfc;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setCalle_numero($calle_numero): void {
        $this->calle_numero = $calle_numero;
    }

    function setColonia($colonia): void {
        $this->colonia = $colonia;
    }

    function setMunicipio($municipio): void {
        $this->municipio = $municipio;
    }

    function setCodigo_postal($codigo_postal): void {
        $this->codigo_postal = $codigo_postal;
    }

    function setEstado($estado): void {
        $this->estado = $estado;
    }

    function setUbicación_maps($ubicación_maps): void {
        $this->ubicación_maps = $ubicación_maps;
    }
    
    function getLocalSuppliers(){
        $sql = "SELECT * FROM proveedor ORDER BY id";
        $query = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));;
        return $query;
    }
    

       
}

?>