<?php
include_once 'models/usuario.php';
include_once 'models/proveedor.php';


class UsuarioController{
    
    public function index(){
        //Pantalla inicial
        //Si no esta registrado, podrá ver proveedores locales pero no podrá subir archivos
        //Carga de proveedores Locales
        $supplier = new proveedor();
        $suppliers = $supplier->getLocalSuppliers();
        $_SESSION['register'] = 'new_register';
        require_once 'views/archivo/subir.php';
    }
    
    public function entrar(){
        require_once 'views/usuario/login.php';
    }
    
    public function registrar(){
        require_once 'views/usuario/register.php';
    }
    

    public function salir(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['cliente'])){
            unset($_SESSION['cliente']);
        }
        header("Location:".base_url);
    }
    
    public function save(){
        //Crea el perfil básico
        //Correo y Constraseña <- el cuál se podrá conectar con Paypal y realizar el pago pago por allí
        
        // Verificamos que llegue la solicitud POST
        if(isset($_POST)){
            //Verificamos las entradas
            $tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : false; // El tipo de usuario provendrá del cual formulario venga (vendrá de una variable Hidden)
            $mail = isset($_POST['mail']) ? $_POST['mail'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            // Guarda entradas en el modelo
            
            //Instanciamos un objeto de la clase Usuario
            $usuario = new Usuario();
            
            
            //Seteamos las variables en el modelo
            $usuario->setTipo_usuario($tipo_usuario); 
            $usuario->setMail($mail);
            $usuario->setPassword($password);
            //Se guarda el registro en el modelo
            $save = $usuario->save();
            // Se verifica si el registro en el modelo fue exitoso.
            if($save){
                    $_SESSION['register']= "complete";
                } else {
                    $_SESSION['register']= "failed";
            }
        }else{
            $_SESSION['register']= "failed";
        }
        header("Location:".base_url.'usuario/entrar');
            
    }
        
    
    public function login(){
        //Se Verifica que llegue la solicitud 
        if(isset($_POST)){
            //Verificamos las entradas
            $usuario = new Usuario();
            $usuario->setMail($_POST['mail']);
            $usuario->setPassword($_POST['password']);
            
            $identity = $usuario->login();
            
            // Se crea la sesión
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                
                //Se verifica si es cliente
                $id = $_SESSION['identity']->id;
                $cliente = new Usuario();
                $cliente->setId($id);
                $client = $cliente->IsClient();
                //$client devuelve True or False

                if($client && is_object($client)){
                    //Es cliente
                    $_SESSION['cliente'] = $client;
                   
                }else{
                    // No Es cliente    
                    $_SESSION['cliente'] = 'notIsClient';
                }
                
                header("Location:".base_url); 
                die();
                
            }else{
                $_SESSION['error_login'] =  'identificacion fallida!!';
                header("Location:".base_url);
                die();
            }
        }
        $_SESSION['error_login'] =  'identificacion fallida!!';
        header("Location:".base_url);
        die();
        
        //ob_end_flush();
    }
    

    public function delete(){
        
    }
    
    public function edit(){
        
    }
    
    public function perfil(){
        
    }
    
    
}
// Metodos
// - Guardar Usuario
// - Logear Usuario
// - Guardar 
// - Perfil del Usuario


?>