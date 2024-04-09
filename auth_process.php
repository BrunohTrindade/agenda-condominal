<?php

  require_once("config/db.php");
  require_once("config/globals.php");
  require_once("models/message.php");
  require_once("models/user.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDAO = new UserDAO($conn, $BASE_URL);

  $user = new User();

  #pega TYPE e filtra oque vier no post
  $type = filter_input(INPUT_POST, "type");

  # Verifica oque vier no post type

  if($type === "register"){

    $name  = filter_input(INPUT_POST, "name");
    $username  = filter_input(INPUT_POST, "name_user");
    $email = filter_input(INPUT_POST,"email");
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirm_password");

    //Verificação de daddos minimos
    if($name && $username && $email && $password && $confirmPassword){

      //Verificar se as senhas são iguais
      if($password === $confirmPassword){

        //Verificar se o usuario já esta cadastrado
        if($userDAO->findByUser($username) == false){

         //criação de senha

         $finalPassword = $user->generatePassword($password);
         $token = $user->generateToken();
         
         $user->name = $name;
         $user->username = $username;
         $user->email = $email;
         $user->token = $token;
         $user->password = $finalPassword;         

         $checkUser = $userDAO->createUser($user);

         if($checkUser){
          $message->setMessage("Conta criada com sucesso! <b>Faça o login:<b>", "success", "sign-in.php");
         }else{
          $message->setMessage("Ocorreu um erro ao cadastrar usuario.", "success", "sign-up.php");
         }
          
        }else{

          // Envia menssagem de erro caso Usuario ja esteja cadastrado
          $message->setMessage("Usuario já cadastrado!", "warning", "sign-up.php");

        }
      }else{


        $message->setMessage("Senhas nao conferem","warning", "sign-up.php");


      }
     

    }else{

     $message->setMessage("Por favor, preencha todos os campos","warning", "sign-up.php");
     
    }


  }else if($type === "login"){

    $username = filter_input(INPUT_POST, "name_user");
    $password = filter_input(INPUT_POST, "password");

        // verifica se o usuario existe
        if($userDAO->findByUser($username)){

          if($userDAO->authenticateUser($username, $password)){

            $message->setMessage("Bem vindo, ".$_SESSION['username']."", "success", "index.php");

          }else{
            
            $message->setMessage("Senha incorreta", "danger", "sign-in.php");
           
          }

        }else{
          
          $message->setMessage("Usuário $username não encaontrado", "warning", "sign-in.php");

        }
  }else if($type == "changePassword"){

    $pass = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirm_password");
    $username = $_SESSION['username'];
     //Verificar se as senhas são iguais
     if($pass == $confirmPassword){

      $password = $user->generatePassword($pass);

      $changePassword = $userDAO->changePassword($username, $password);

      if($changePassword)
      {
        $message->setMessage("Senha alterada com sucesso!", "success", "index.php");
      }else
      {
        $message->setMessage("Erro ao alterar a senha", "danger", "index.php");
      }
     }

  }


?>