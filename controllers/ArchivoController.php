<?php

include_once 'models/archivo.php';
include_once 'models/pedido.php';

class ArchivoController{
    
    public function upload_file(){
        if (isset($_POST)){
            //Colocar aqui un validador de archivo
            //https://www.php.net/manual/es/features.file-upload.php
            if(isset($_FILES['my_file'])){
                $cliente_id = 1;
                $pedido_id = null;
                $servicio_id = isset($_POST['servicio_id']) && $_POST['servicio_id'] ? $_POST['servicio_id'] : false;
                $proveedor_id = $_SESSION['supplier'];
                //Validar el servicio
                // Get the services with the prices
                // DEFAULT
                //Size Paper
                $sizePaperDefault = isset($_POST['size_paper']) && $_POST['size_paper'] ? $_POST['size_paper'] : false;
                //Print Service (COLOR /B/N)
                $printServDefault = isset($_POST['print_serv']) && $_POST['print_serv'] ? $_POST['print_serv'] : false;
                //Orientación
                $orientacion = isset($_POST['orientation']) && $_POST['orientation'] ? $_POST['orientation'] : false; //Char(3)
                //Validación de las hojas:
                //isset($_GET['id']) ? $_GET['id'] : false;
                $from_x = isset($_POST) && is_numeric($_POST['from_x']) ? $_POST['from_x'] : false; 
                $to_y = isset($_POST) && is_numeric($_POST['to_y'])? $_POST['to_y'] : false; // Varchar(50)
                
                //Esta validación bien se podría hacer en el cliente JS
                if($from_x > $to_y){
                    $_SESSION['query'] = 'failed'; 
                    return header('Location:'.base_url);//No es correcta esta operacion
                }else{
                    if($to_y != $from_x){
                        $numSheets = $to_y - $from_x;
                    }else{
                        $numSheets = 1;
                    }
                }

                //Instancia el pedido
                $pedido = new pedido;

                //Make Folio
                //$pedido->setFolio(); // Falta agregar un folio al pedido *Investigar construccion de folios

                $pedido->setProveedor_id($proveedor_id);
                //Inserta el registro en la BDD
                $pedidoInfo = $pedido->makeOrder(); //Devuelve false o el objecto arreglo con los datos del pedido

                if($pedidoInfo != null){
                    if(isset($sizePaperDefault) && isset($printServDefault)){
                         //Set Data
                         //From File
                        $myFile = $_FILES['my_file'];
                        $nombre = $myFile['name'];
                        $string_nombre = implode('',$nombre);   //Un elemento de un array en un string                
                        $tipo = $myFile['type'];
                        $string_tipo = implode('',$tipo); //Un elemento de un array en un string

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
                        $archivo->setPedido($pedidoInfo->folio);
                        $archivo->setCliente_id($cliente_id);
                        $archivo->setPedido_id($pedidoInfo->id);
                        $archivo->setProveedor_id($proveedor_id);
                        //Servicios Adicionales*
                        $archivo->setServicio_id($servicio_id);
                        $archivo->setNombre($string_nombre);
                        $archivo->setTipo($string_tipo);
                        //Servicios Default
                        $archivo->setTamano($sizePaperDefault);
                        $archivo->setColor($printServDefault);
                        $archivo->setOrientacion($orientacion);
                        $archivo->setFrom_x($from_x);
                        $archivo->setTo_y($to_y);
                        $archivo->setNumSheets($numSheets);
                        
                        
                        $_SESSION['file'] = 'file_registered';
                        
                        //Envío de archivos a la BDD y regresa el arreglo (o falso)
                        //Debería recoger los archivos del pedido, esto es que recorra todos los archivos que se encuentren dentro del pedido
                        
                        $archivos = $archivo->upload_file();
                        
                        require_once 'views/layouts/data.php';
                        
                        //header('Location:'.base_url);
                        //Returna el array que se usará para la tabla
                        

                        //Una vez que envia los archivos a la BDD, redirecciona al index con la tabla nueva con los datos
                    }else{
                        //No se tiene seleccionado el servicio
                        $_SESSION['query'] = 'failed'; 
                    }   
                }else{
                    //No se realizó el pedido
                    $_SESSION['query'] = 'failed'; 
                }
            }else{
                //No hay archivo 
                $_SESSION['query'] = 'failed'; 
            }
        }else{
            header('Location:'.base_url); //No hay POST
        }  
        
        
    }
    
    public function files_table(){
        //Realiza consulta a la BDD y muestra los archivos en la tabla
        if(isset($_POST)){
            
            
        }
    }
    
}
 
?>