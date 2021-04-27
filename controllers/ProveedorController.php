<?php   

require_once 'models/';

class ProveedorController{
    
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
