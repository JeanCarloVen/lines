<?php
class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
        $_SESSION[$name] = null;
        unset($_SESSION[$name]);
        }
        return $name;
    }
//    
//    public static function isClient(){
//        if(!isset($_SESSION['cliente']) && $_SESSION['cliente'] == false){
//            header("Location:".base_url);   
//	}else{
//            return true;
//	}
//    }
//    
    public static function isIdentity(){
        $valor = false;
	if(!isset($_SESSION['identity'])){
            $valor;
	}else{
             $valor = true;
	}
        return $valor;
    }
        
    
    
}