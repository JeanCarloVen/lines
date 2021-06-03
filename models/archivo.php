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
    private $numSheets;
    private $pedido;
    private $datePedido;
    private $proveedor_id;
    private $db;
    
    public function __construct() {
            $this->db = Database::connection();
    }
    
    function getPedido() {
        return $this->pedido;
    }

    function setPedido($pedido): void {
        $this->pedido = $pedido;
    }
    function getDatePedido() {
        return $this->datePedido;
    }

    function setDatePedido($datePedido): void {
        $this->datePedido = $datePedido;
    }

    function getNumSheets() {
        return $this->numSheets;
    }

    function setNumSheets($numSheets): void {
        $this->numSheets = $numSheets;
    }

        
    function getProveedor_id() {
        return $this->proveedor_id;
    }

    function setProveedor_id($proveedor_id): void {
        $this->proveedor_id = $proveedor_id;
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
        $last_id = null;
        //Inserta el pedido (Sólo sino ha sido creado antes)
        //VALIDA QUE NO EXISTE EL PEDIDO, de lo contrario crea otro nuevo
        //Consulta si exite pedido
        $sqlPedido= "SELECT * FROM pedido WHERE id={$this->getPedido_id()}";
        $query = $this->db->query($sqlPedido) or die ('Error en el query database' .mysqli_error($this->db));
        
        if(!$query){
            //Genera Pedido
            $sqlPedido = "INSERT INTO pedido (id, folio, fecha, proveedor_id, descripcion) VALUES (NULL, {$this->getFolio()}, NOW(), {$this->getProveedor_id()}, {$this->getDescripcion()};";
            $upload_file = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
            $last_id = $this->db->insert_id;
        }

        //Inserta el archivo
        $sqlArchivo = "INSERT INTO archivo (id, cliente_id, pedido_id, servicio_id, nombre, tipo, tamano, color, orientacion, from_x, to_y,  fecha ) VALUES (NULL, {$this->getCliente_id()}, {$this->getPedido_id()}, {$this->getServicio_id()}, '{$this->getNombre()}', '{$this->getTipo()}', {$this->getTamano()}, {$this->getColor()}, '{$this->getOrientacion()}', {$this->getFrom_x()}, {$this->getTo_y()}, NOW());";
        $upload_file = $this->db->query($sqlArchivo) or die ('Error en el query database' .mysqli_error($this->db));
        
        $last_id = $this->db->insert_id;
        
        //CONSULTA para obtener el importe, seguramente con el inner join y lista de precios
        //Consulta a los precios según el archivo 
        //Necesito saber cual es el precio del servicio
        
        //Obtenemos el precio de los servicios por default
        //Tamaño del papel
        $sql= "SELECT sp.id, sp.fecha, sp.proveedor_id, sp.precio_unitario FROM serviciodef_proveedor AS sp WHERE proveedor_id = {$this->getProveedor_id()} AND sp.servicio_default_id = {$this->getTamano()}";
        $querySizePaper = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        $resultadoSizePaper = $querySizePaper->fetch_object();
        
        //Impresion (color /BN)
        $sql= "SELECT sp.id, sp.fecha, sp.proveedor_id, sp.precio_unitario FROM serviciodef_proveedor AS sp WHERE proveedor_id = {$this->getProveedor_id()} AND sp.servicio_default_id = {$this->getColor()};";
        $queryImpresion = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        $resultadoImpresion = $queryImpresion->fetch_object();
        
        //Envió a la tabla de los datos
        $order = $this->getPedido();
        $dateOrder = $this->getDatePedido();
        $name = $this->getNombre();
        $type = $this->getTipo();
        $sizeSheet = $this->getTamano();
        $color = $this->getColor();
        $orientation = $this->getOrientacion();
        $fromX = $this->getFrom_x();
        $toY = $this->getTo_y();
        
        //Calculo del importe
        $unitPriceSizePaper = $resultadoSizePaper->precio_unitario;
        $unitPricePrint = $resultadoImpresion->precio_unitario;
        $amounSheets = $this->getNumSheets();
        $unitPrice = $unitPriceSizePaper + $unitPricePrint;
        $importe = $unitPrice*$amounSheets;
        
        //Genera el array de datos
        $datos = array($order, $dateOrder, "nombre" => $name, "tipo" => $type, "tamano" => $sizeSheet, "color" => $color, "orientacion" => $orientation, "from_x" => $fromX, "to_y" => $toY, "PU" => $unitPrice);
        
        //var_dump($this->getPedido_id());
        //var_dump($importe);
        //Actualiza el importe en la tabla de pedido
        $sql = "UPDATE pedido SET importe={$importe} WHERE id={$this->getPedido_id()};";
        $resultadoPedido = $this->db->query($sql);
        //var_dump($resultadoPedido);
        
        //Consulta al pedido
        $sqlPedido = "SELECT * FROM pedido WHERE id={$this->getPedido_id()}";
        $query = $this->db->query($sqlPedido) or die ('Error en el query database' .mysqli_error($this->db));
        
        
        //ARREGLO
        if($query && $query->num_rows === 1){
            $upload = $query->fetch_object();
            //var_dump($upload);   
        }
        
        //Merge arrays
        $merged_upload = array_merge($datos, (array)$upload);
        //var_dump($merged_upload);
        return $merged_upload; //Devuelve un arreglo, no un objeto
        
         
    }
    
        
        
        
}


?>