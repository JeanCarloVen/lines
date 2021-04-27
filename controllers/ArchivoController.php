<?php

include_once 'models/archivo.php';
include_once 'models/pedido.php';

class ArchivoController{
    
    public function upload_file(){
        if (isset($_FILES['my_file']) && isset($_POST)) {
            $cliente_id = 1;
            $pedido_id = null;
            //Set Proveedor
            $proveedor_id = $_POST['proveedor_id']; //Debo obtener un INT del proveedor

            //Instancia el pedido
            $pedido = new pedido;
            
            //Make Folio
            $pedido->setFolio(); // Falta agregar un folio al pedido *Investigar construccion de folios
            
            //Recoge datos del pedido
            $pedido->setProveedor_id($proveedor_id);
            
            //Inserta el registro en la BDD
            $pedido_id = $pedido->makeOrder(); //Devuelve false o el id del pedido
            
            if(!$pedido_id && $pedido_id != null){
                //Validar el servicio
                //Consulta de si existe la variable de servicio solicitada
                
                //El servicio indica el precio
                //Precio Unitario 1 = B/N o Color
                //Precio Unitario 2= Carta u Oficio
                //importe = (PU1 +PU2)* Cantidad
                //Ej. (($0.50) + ($1.20))(50)
                if($servicio_id){
                    
                }else{
                    //No se tiene seleccionado el servicio
                }
                
                  //Set Data
                $myFile = $_FILES['my_file'];
                $nombre = $myFile["name"];
                $tipo = $myFile["type"];
                
                $orientacion = $_POST['orientation']; //Char(3)
                $from_x = $_POST['from_x']; // Varchar(50
                $to_y = $_POST['to_y']; // Varchar(50)

                $fileCount = count($myFile["name"]);
    //            for ($i = 0; $i < $fileCount; $i++) {
    //                    $i+1;
    //                    echo $myFile["name"][$i];
    //                    echo $myFile["tmp_name"][$i];        
    //                    echo "Type " .$myFile["type"][$i];
    //                    echo $myFile["size"][$i];
    //                    echo $myFile["error"][$i];  
    //            }
                //Instancia y Seteo de parámetros
                $archivo = new archivo();
                $archivo->setCliente_id($cliente_id);
                $archivo->setPedido_id($pedido_id);
                $archivo->setServicio_id($servicio_id);
                $archivo->setNombre($nombre);
                $archivo->setTipo($tipo);
                $archivo->setTamano($tamano);
                $archivo->setColor($color);
                $archivo->setOrientacion($orientacion);
                $archivo->setFrom_x($from_x);
                $archivo->setTo_y($to_y);

                //Envío de archivos a la BDD y regresa el arreglo (o falso)
                $archivos = $archivo->upload_file();

                //Calculo del Importe
                //$importe = $archivos->precio_unitario*$archivos->cantidad

                //Returna el array que se usará para la tabla
                //Una vez que envia los archivos a la BDD, redirecciona al index con la tabla nueva con los datos
                require_once 'views/archivo/subir.php';
            }else{
                //No se realizó el pedido
            }
        }else{
            header('Location:'.base_url);    
        }
        //1) Validación del archivo: PDF, DOC, JPG, PNG, SVG
        //2) El usuario deberá de DAR INFORMACIÓN
        //3) Si el archivo es de texto, deberá indicar numero paginas a imprimir COLOR o B/N, Orientación

    }
    
    public function files_table(){
        //Realiza consulta a la BDD y muestra los archivos en la tabla
        if(isset($_POST)){
            
            
        }
    }
    
}
 
?>