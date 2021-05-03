<?php   

require_once 'models/proveedor.php';
require_once 'models/pedido.php';
require_once 'models/servicio.php';


class ProveedorController{
    //Selecciona Proveedor: obtiene sus servicios
    public function selectSupplier(){
        if(isset($_POST)){
            $proveedor_id = $_POST['proveedor_id']; //Debo obtener un INT del proveedor
//            //Instancia el pedido
//            $pedido = new pedido;
//            
//            //Make Folio
//            //$pedido->setFolio(); // Falta agregar un folio al pedido *Investigar construccion de folios
//           
//            $pedido->setProveedor_id($proveedor_id);
//            //Inserta el registro en la BDD
//            $pedido_id = $pedido->makeOrder(); //Devuelve false o el id del pedido
//            
            //Consulta de servicios de acuerdo al proveedor seleccionado            
            $allServices = new servicio();
            $allServices->setProveedor_id($proveedor_id);
            $getServices = $allServices->getAllServices();           
            if($getServices){
                $_SESSION['supplier_check'] = true;
            }
            $_SESSION['supplier_check'] = false;
            
        }
         header("Location:".base_url);
    }
    
    public function getLocalProvider(){
        //Obtiene la lista de proveedores, según la ubicación 
        if(isset($_GET)){
            
        }
        //Retorna la lista de proveedores
            
    }
    
    public function setLocalProvider(){
        //Establece al Proveedor Local
        //Retorna el Proveedor_id seleccionado
        if(isset($_GET)){
            //obtenemos el ID del proveedor seleccionado
            $proveedor_id = isset($_GET['id']) ? $_GET['id'] : false;
            
            //realiza consulta considerando el id del proveedor
            $supplierSelected = new proveedor();
            $supplierSelected->setLocalSupplier($proveedor_id);
         
            
        }
        
        
        //return;
       
        
    }
    
    
    
    
    
}
// Métodos
// - Alta de servicios
// - Editar Servicios
// - Borrar Servicios
// 
// - Alta de productos
// - Editar productos
// - Borrar Productos
// 





?>
