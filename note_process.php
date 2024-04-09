<?php

date_default_timezone_set('America/Sao_Paulo');

include_once("models/message.php");
include_once("dao/noteDAO.php");
include_once("dao/userDAO.php");
include_once("dao/condominoDAO.php");

$noteDAO = new NoteDAO($conn, $BASE_URL);

$userDAO = new UserDAO($conn, $BASE_URL);

$condomino = new CondominoDAO($conn, $BASE_URL);

$message = new Message($BASE_URL);


$nomeCondomino = filter_input(INPUT_POST, 'id_cond');
$categoria = filter_input(INPUT_POST, 'categoria');
$prioridade = filter_input(INPUT_POST, 'prioridade');
$data_exp = filter_input(INPUT_POST, 'data_exp');
$recado = filter_input(INPUT_POST, 'recado');
$type = filter_input(INPUT_POST, 'type');
$today = date('y-m-d H:i');
$id = filter_input(INPUT_POST, "id");
$concluir = filter_input( INPUT_POST, "concluir");



if($type == "register"){

  if($userDAO->findByUser($_SESSION['username'])){

    if($condomino->findCondomino($nomeCondomino)){

      $id_cond = $condomino->findCondomino($nomeCondomino);

      $nome = $id_cond->id;
      
      $note = new Note();

      $note->id_cond = $nome;
      $note->id_user = $_SESSION['username'];
      $note->categoria = $categoria;
      $note->prioridade = $prioridade;
      $note->recado = $recado;
      $note->data_cad = $today;
      $note->data_exp = $data_exp;     

      if($noteDAO->createNote($note)){

        $message->setMessage("$categoria criado com sucesso!", "success", "recados.php");

      }else
      {
        $message->setMessage("Infelizmente, algo deu errado. Tente de novo, ou procure o desenvolvedor.", "error", "recados.php");
      }

    }else{
      $message->setMessage("Nome do morador inválido. O nome deve estar previamente cadastrado.", "error", "recados.php");
    }
    
    $note = new Note();


  }else{
    $message->setMessage("Você precisa estar logado para fazer reservas!", "error", "recados.php");
  }
}

if($type == 'update'){
  
  $note = new Note;

  $note->categoria = $categoria;
  $note->prioridade = $prioridade;
  $note->data_exp = $data_exp;
  $note->recado = $recado;
  $note->alter_user = $_SESSION['username'];
  $note->alter_date = $today;
  $note->concluir = $concluir;
  $note->id = $id;

  if($concluir == 0){

    $checkUpdate = $noteDAO->updateNote($note, $concluir);

  }else{

    $checkUpdate = $noteDAO->updateNote($note, $concluir);

  }
  
  if($checkUpdate){

    $message->setMessage("Recado editado com sucesso!", "success", "recados.php");

  }else{

    $message->setMessage("Infelizmente, algo deu errado. Tente de novo, ou procure o desenvolvedor.", "error", "recados.php");

  }


}
if($type == 'concluir'){

  $motivo = filter_input(INPUT_POST, "motivo_conc");
  $concluir = 1;
  $today = date('y-m-d');
  $note = new Note;

  $note->conc_user = $_SESSION['username'];
  $note->date_conc = $today;
  $note->concluir = $concluir;
  $note->motivo_conc = $motivo;
  $note->id = $id;

  $concludeModel = $noteDAO->concludeNote($note);

  if($concludeModel){

    $message->setMessage("Recado $id concluido com sucesso!", "success", "recados.php");
  }else{
    $message->setMessage("Erro ao concluir recado $id!", "error", "recados.php");
  }
}

header("Location: recados.php");