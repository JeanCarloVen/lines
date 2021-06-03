<?php

class Usuario{
    private $id;
    private $tipo_usuario;
    private $mail;
    private $password;
    private $db;
    
    public function __construct() {
        $this->db = Database::connection();
    }
    
    function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    function setTipo_usuario($tipo_usuario): void {
        $this->tipo_usuario = $tipo_usuario;
    }
  
    function getId() {
        return $this->id;
    }

    function getMail() {
        return $this->mail;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setMail($mail): void {
        $this->mail = $mail;
    }

    function setPassword($password): void {
        $this->password = $password;
    }
    
    public function save() {
        $sql = "INSERT INTO usuario (id, tipo_usuario, correo, contrasena) VALUES (NULL, '{$this->getTipo_usuario()}', '{$this->getMail()}', '{$this->getPassword()}');";
        $save = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
    
    public function login(){
        $result = false;
        $mail = $this->mail;
        $password = $this->password;
        $sql = "SELECT * FROM usuario WHERE correo = '$mail'";
        $login = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));
        
        if($login && $login->num_rows == 1){
            
            
            $usuario_reg = $login->fetch_object();
            //Verificar la contrasena
            $verify = password_verify($password, $usuario_reg->contrasena);
     
            if($verify){
                $result = $usuario_reg;
            }
        }
        return $result;
        
    }
    
    //Parece que será necesario hacer una busqueda en ambas tablas Cliente y Usuario para determinar si es Cliente
    //Usaremos el id del 
    public function IsClient(){
        $result = false;
        $id = $this->getId();
        $sql = "SELECT * FROM cliente WHERE usuario_id = '$id'";
        $check = $this->db->query($sql) or die ('Error en el query database' .mysqli_error($this->db));

        if($check && $check->num_rows == 1){
            $result = $check->fetch_object(); //Devuelve el objeto
        }
        return $result;
    }
    
}
?>