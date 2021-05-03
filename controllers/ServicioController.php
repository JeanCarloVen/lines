<?php 
 
require_once 'models/servicio.php';
 
class ServicioController{
    public function index(){
        //Consulta a la base de datos, para ver los servicios del proveedor 
        //Default
        $servicio = new servicio();
        $proveedor_id = 1;
        $servicio->setProveedor_id($proveedor_id);
        $servicios = $servicio->getAllServices();
        require_once 'views/proveedor/alta_servicio.php';
    }
    
    public function getServicesDefault(){
        if(isset($_POST)){
            $proveedor_id = $_POST['proveedor_id']; //Debo obtener un INT del proveedor
            //Consulta de servicios de acuerdo al proveedor seleccionado            
            $allServices = new servicio();
            $allServices->setProveedor_id($proveedor_id);
            $sizePaperServices = $allServices->getSizePaperServices();
            
            if($sizePaperServices->num_rows > 0){
                $printServices = $allServices->getPrintServices();
                if($printServices->num_rows != 0){
                    $_SESSION['supplier_check'] = true;
                }else{
                    $_SESSION['query'] = 'failed'; // No encontró PRINT (Servicios de Impresion)
                }
                $_SESSION['supplier_check'] = false;
                $_SESSION['register'] = 'old_register';
            }else{
                $_SESSION['query'] = 'failed'; //No encontró SIZE_PAPER
            }   
        }
        require_once 'views/archivo/subir.php';
    }

    
    public function addService(){
        //Cuando recibe el servicio debe guardarlo en una variable nueva    
        $servicios = [];
        
        //En cada $_POST se agrega a la lista de servicios
        if(isset($_POST['servicios'])){
            $servicios = $_POST['servicios'];
        }
        
        if(isset($_POST['guardar'])){
            //Recupera el id del proveedor
            $proveedor_id = 1;
            $status = 'ACT';
            $sku = isset($_POST['sku']) ? $_POST['sku'] : false;
            $desc = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $pu = isset($_POST['pu']) ? $_POST['pu'] : false;
            //$proveedor_id = isset($_POST['proveedor_id']) ? $_POST['proveedor_id'] : false;
            //Envia a la NDD para guardar en la tabla de servicio
            
            $servicios = new servicio();
            $servicios->setProveedor_id($proveedor_id);
            $servicios->setStatus($status);
            $servicios->setSKU($sku);
            $servicios->setDescripcion($desc);
            $servicios->setPrecio_unitario($pu);
            
            //Calculo comisión Menudeo
            $comision_menudeo = 0.2* round(floatval($pu), 2);

            //Consulta a la BDD
            $servicios->setComision_menudeo($comision_menudeo);
            
            //Consulta a la BDD
            $serv = $servicios->setServicios(); //Devuelve true/false
            
            //Mensaje de servicio guardado o mensaje de servicio no guardado 
            if($serv){
                $_SESSION['servicio'] = "complete";
            }else{
                $_SESSION['servicio'] = "failed";
            }  
        }
        header('Location:'.base_url.'servicio/index'); 

        
    }
    
    
}


?>