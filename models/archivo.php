<?php

class archivo{
    private $id;
    private $cliente_id;
    private $pedido_id;
    private $servicio_id;
    private $nombre;
    private $tipo;
    private $tamano;
    private $fecha;
    private $color;
    private $orientacion;
    private $from_x;
    private $to_y;
    private $db;
    
    public function __construct() {
            $this->db = Database::connection();
    }
    function getServicio_id() {
        return $this->servicio_id;
    }

    function setServicio_id($servicio_id): void {
        $this->servicio_id = $servicio_id;
    }

    function getColor() {
        return $this->color;
    }

    function getOrientacion() {
        return $this->orientacion;
    }

    function getFrom_x() {
        return $this->from_x;
    }

    function getTo_y() {
        return $this->to_y;
    }

    function setColor($color): void {
        $this->color = $color;
    }

    function setOrientacion($orientacion): void {
        $this->orientacion = $orientacion;
    }

    function setFrom_x($from_x): void {
        $this->from_x = $from_x;
    }

    function setTo_y($to_y): void {
        $this->to_y = $to_y;
    }
    
    function getId() {
        return $this->id;
    }

    function getCliente_id() {
        return $this->cliente_id;
    }

    function getPedido_id() {
        return $this->pedido_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTamano() {
        return $this->tamano;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setCliente_id($cliente_id): void {
        $this->cliente_id = $cliente_id;
    }

    function setPedido_id($pedido_id): void {
        $this->pedido_id = $pedido_id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    function setTamano($tamano): void {
        $this->tamano = $tamano;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function upload_file(){
        $upload = false;
        //Inserta el pedido (Sólo sino ha sido creado antes)
        //VALIDA QUE NO EXISTE EL PEDIDO, de lo contrario crea otro nuevo
        //Consulta si exite pedido
        $sqlPedido= "SELECT * FROM pedido WHERE id={$this->getPedido_id()}";
        $query = $this->db->query($sqlPedido) or die ('Error en el query database' .mysqli_error($this->db));
        
        if(!$query){
            //Genera Pedido
            $sqlPedido = "INSERT INTO pedido (id, folio, fecha, proveedor_id, descripcion) VALUES (NULL, {$this->getFolio()}, NOW(), {$this->getProveedor_id()}, {$this->getDescripcion()};";
            $upload_file = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        }else{
            //El pedido ya se econtraba en la base de datos, por lo tanto debe de crearse uno nuevo
        }
   
        $last_id = $this->db->insert_id;
        
        //Inserta el archivo
        $sqlArchivo = "INSERT INTO archivo (id, cliente_id, pedido_id, nombre, tipo, tamano, color, orientacion, from_x, to_y,  fecha ) VALUES (NULL,{$this->getCliente_id()}, {$this->getPedido_id()}, {$this->getNombre()}, {$this->getTipo()}, {$this->getTamano()}, {$this->getColor()}, {$this->getOrientacion()}, {$this->getFrom_x()}, {$this->getTo_y()}, NOW());";
        $upload_file = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        
        $last_id = $this->db->insert_id;
        
        //CONSULTA para obtener el importe, seguramente con el inner join y lista de precios
        //Consulta a los precios según el archivo 
        //Necesito saber cual es el precio del servicio
        
        //$sql= "SELECT * FROM archivo WHERE id={$this->$last_id}";
        $sql= "SELECT * FROM archivo WHERE id={$this->$last_id} INNER JOIN servicio ON archivo.servicio_id = servicio.id ";
        $query = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));

        //ARREGLO
        if($query && $query->num_rows == 1){
            $upload = $query->fetch_object();
        }
        
        return $upload;
         
    }
    
        
        
        
}


?>