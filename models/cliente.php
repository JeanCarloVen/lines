<?php

    class Cliente{
        private $usuario_id;
        private $tipo_cliente;
        private $nombre;
        private $sexo;
        private $correo;
        private $telefono;
        private $calle_numero;
        private $colonia;
        private $municipio;
        private $codigo_postal;
        private $saldo;
        private $db;
    
        public function __construct() {
            $this->db = Database::connection();
        }
    
        function getUsuario_id() {
            return $this->usuario_id;
        }

        function getTipo_cliente() {
            return $this->tipo_cliente;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getSexo() {
            return $this->sexo;
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

        function getSaldo() {
            return $this->saldo;
        }

        function setUsuario_id($usuario_id): void {
            $this->usuario_id = $usuario_id;
        }

        function setTipo_cliente($tipo_cliente): void {
            $this->tipo_cliente = $tipo_cliente;
        }

        function setNombre($nombre): void {
            $this->nombre = $nombre;
        }

        function setSexo($sexo): void {
            $this->sexo = $sexo;
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

        function setSaldo($saldo): void {
            $this->saldo = $saldo;
        }
        
        function saveSaldo(){
            var_dump($this->getUsuario_id());
            var_dump($this->getSaldo());
            
            $sql = "UPDATE cliente SET saldo = {$this->getSaldo()} WHERE usuario_id={$this->getUsuario_id()};";
            $saveSaldo = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
            $result = false;
            if($saveSaldo){
                $result = true;
            }
            return $result;
        }
        
        function saveClient(){
            $sql = "INSERT INTO cliente ("
                    . "id,"
                    . "usuario_id,"
                    . "tipo_cliente,"
                    . "nombre, "
                    . "sexo,"
                    . "telefono,"
                    . "calle_numero,"
                    . "colonia,"
                    . "municipio,"
                    . "codigo_postal,"
                    . "saldo"
                    . ")"
                    . "VALUES"
                    . "("
                    . "NULL,"
                    . "{$this->getUsuario_id()},"
                    . "'{$this->getTipo_cliente()}',"
                    . "'{$this->getNombre()}',"
                    . "'{$this->getSexo()}',"
                    . "'{$this->getTelefono()}',"
                    . "'{$this->getCalle_numero()}',"
                    . "'{$this->getColonia()}',"
                    . "'{$this->getMunicipio()}',"
                    . "'{$this->getCodigo_postal()}',"
                    . "0"
                    . ");";
                    
            $saveClient = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
            $result = false;
            if($saveClient){
                $result = true;
            }
            return $result;

        }
        
      


    }


?>