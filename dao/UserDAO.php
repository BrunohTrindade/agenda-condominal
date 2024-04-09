<?php
 
  require_once ("models/user.php");
  require_once ("models/message.php");

  Class UserDAO implements UserDAOinterface { 

      private $conn;
      private $url;
      private $message;     

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;      
        $this->message = new Message($url);
    }

    public function buildUser($data){

      $user = new User();

      $user->id = $data["id"];
      $user->name = $data["nome"];
      $user->username = $data["username"];
      $user->email = $data["email"];
      $user->token = $data["token"];
      $user->password = $data["senha"];

      return $user;
      
    }

    public function createUser(User $user){
    
      $stmt  = $this->conn->prepare("INSERT INTO usuario (nome, username, email, senha) 
                                    VALUES 
                                    (:nome, :username, :email, :senha)");

      $stmt->bindParam(":nome", $user->name);
      $stmt->bindParam(":username", $user->username);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":senha", $user->password);

      $stmt->execute();

      if($stmt->rowCount() > 0){
      
         return true;
      }else{
        return false;
      }

      // Autenticar usuario caso AUTH seja true

    }

    public function findByUser($username){

     if($username != ""){

      $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE username = :username");
      $stmt->bindParam(":username", $username);
      $stmt->execute();
        if($stmt->rowCount() > 0){
          
         $data = $stmt->fetch();
         $user = $this->buildUser($data); 

         return $user;

        }else{
          return false;
        }
     }else{
      return false;
     }
    }

    public function findUserByid($id){

      $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE id = :id");
      $stmt->bindParam(":id", $id);
      $stmt->execute();
        if($stmt->rowCount() > 0){
          
        $data = $stmt->fetch();
        $user = $this->buildUser($data); 

        return $user;

        }else{
          return false;
        }
      
     }

    public function authenticateUser($username, $password){
      
      $user = $this->findByUser($username);

      if($user){

        if(password_verify($password, $user->password)){

          $_SESSION['username'] = $user->username;
          $_SESSION['id'] = $user->id;
          return true;
         

        }else{

          return false;

        }

      }else{
        return false;
      }
     
    }

    public function setTokenUser(){

    }

    public function changePassword($username, $password)
    {
      $stmt = $this->conn->prepare("UPDATE usuario SET senha = :senha WHERE username = :username");
      $stmt->bindParam(":senha", $password);
      $stmt->bindParam(":username", $username);

      $stmt->execute();

      if($stmt->rowCount() > 0 ){
        return true;
      }else{
        return false;
      }
    }
  }
  