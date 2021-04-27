<?php
include_once 'models/cliente.php';

class ClienteController{
    
    public function recargar(){
        require_once 'views/usuario/recharge.php';
    }
    
    public function registrarCliente(){
        require_once 'views/usuario/client_register.php';
    }
    
    public function ready(){
        require_once 'views/cliente/ready.php';
    }
   
    
    public function saveClient() {
        if(isset($_SESSION['identity'])){
            if(isset($_POST)){
                
                //Se reciben y verifican las variables
                $usuarioId = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
                $tipo_cliente = isset($_POST['type_client']) ? $_POST['type_client']: false;
                $name = isset($_POST['name']) ? $_POST['name']: false;
                $sex = isset($_POST['sex']) ? $_POST['sex']: false;
                $phone = isset($_POST['phone']) ? $_POST['phone']: false;
                $street = isset($_POST['street']) ? $_POST['street']: false;
                $neighborhood = isset($_POST['neighborhood']) ? $_POST['neighborhood']: false;
                $location = isset($_POST['location']) ? $_POST['location']: false;
                $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code']: false;
                
                //Se mandan las variables al modelo del cliente
                $cliente = new Cliente();
                $cliente->setUsuario_id($usuarioId);
                $cliente->setTipo_cliente($tipo_cliente);
                $cliente->setNombre($name);
                $cliente->setSexo($sex);
                $cliente->setTelefono($phone);
                $cliente->setCalle_numero($street);
                $cliente->setColonia($neighborhood);
                $cliente->setMunicipio($location);
                $cliente->setCodigo_postal($postal_code);
                $save = $cliente->saveClient();
                
                //Se valida si se salvo o no el cliente
                if($save){
                    $_SESSION['register']= "complete";
                    //Consulta a la base de datos
                    $cliente->IsClient();
                    if($cliente){
                        //Es cliente
                        $_SESSION['cliente'] = $cliente;
                    
                    }else{
                        // No Es cliente    
                    }
                    
                    header("Location:".base_url."cliente/ready"); //Manda al boton de listo para activar la sessión de cliente
                }else{
                    $_SESSION['register']= "failed";
                    $_SESSION['cliente'] = 'inactivo';             
                }
                
                
                
            }else{
                header("Location:".base_url);
            }
        }else {
            header("Location:".base_url);
        }
        
    }
    
    public function rechargeUser(){
        if(isset($_SESSION['identity'])){
            //Aquí checa que el usuario sea cliente, de lo contrario deberá mandar a registrar los datos de cliente
            if(isset($_SESSION['cliente'])){
                //checa que exista el Post
                if(isset($_POST)){
                    //Obtenemos las variables del Post
                    // - Usuario al que se hara la recarga
                    // - Monto de recarga

                    $id = isset($_POST['id']) ? $_POST['id']: false;
                    $saldo = isset($_POST['recharge']) ? $_POST['recharge']: false;

                    // Instanciamos al cliente
                    $cliente = new cliente();
                    $cliente->setUsuario_id($id);
                    $cliente->setSaldo($saldo);

                    $save = $cliente->saveSaldo();
                    header("Location:".base_url);
                }
            }else{
                //No es cliente y por lo tanto, debe registrarse
                var_dump($_SESSION['cliente']);
                die();
            }
        } else {
            header("Location:".base_url);
        }
    }
}
