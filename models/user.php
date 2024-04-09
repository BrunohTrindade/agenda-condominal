<?php

class User {
  
  public $id_user;
  public $name;
  public $username;
  public $email;
  public $token;
  public $password;


  public function generateToken(){

    return bin2hex(random_bytes(15));

  }

  public function generatePassword($password){

    return password_hash($password, PASSWORD_DEFAULT);
  }

}

interface UserDAOinterface {
  
  public function buildUser($data);
  public function findByUser($username);
  public function createUser(User $user);
  public function authenticateUser($username, $password);
  public function findUserByid($id);
  public function changePassword($user, $password);
  
}
?>