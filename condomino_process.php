<?php
  require_once ("dao/condominoDAO.php");
  require_once ("models/condomino.php");
  require_once ("models/message.php");
  require_once ("models/condomino.php");
  require_once ("config/globals.php");

  $id = filter_input(INPUT_POST, "id");
  $nome = filter_input(INPUT_POST, "nome");
  $casa = filter_input(INPUT_POST, "casa");
  $morador = filter_input(INPUT_POST, "morador");
  $type = filter_input(INPUT_POST, "type");

  $message = new Message($BASE_URL);

  $condominoDAO = new CondominoDAO($conn, $BASE_URL);

  $condomino = new Condomino;
  
  $condomino->nome = $nome;
  $condomino->casa = $casa;

  if($type == "addCondomino"){
    $condomino->morador = 1;
    $create = $condominoDAO->createCondomino($condomino);
    
    if($create == true){
      $message->setMessage("Condômino ".$nome." adicionado com sucesso!", "success", "index.php");
    }else{
      $message->setMessage("Erro ao adicionar novo condômino!", "danger", "index.php");
    }
  }
  if($type == "edit"){

    $condomino->id = $id;
    $condomino->morador = $morador;

    $create = $condominoDAO->EditCondomino($condomino);
    
    if($create == true){
      $message->setMessage("Condômino atualizado com sucesso!", "success", "regimento.php");
    }else{
      // print_r($condomino);
      $message->setMessage("Erro ao atualizar condômino! Contate o desenvolvedor.", "danger", "regimento.php");
    }
  }
  