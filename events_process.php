<?php

date_default_timezone_set('America/Sao_Paulo');

require_once("models/events.php");
require_once("models/message.php");
require_once("dao/UserDAO.php");
require_once("dao/EventsDAO.php");
require_once("dao/CondominoDAO.php");

$condominoDAO = new CondominoDAO($conn, $BASE_URL);

$userDAO = new UserDAO($conn, $BASE_URL);

$message = new Message($BASE_URL);

$newEvent = new eventsDAO($conn, $BASE_URL);

$nomeCondomino = filter_input(INPUT_POST, "id_cond");
$reserva  = filter_input(INPUT_POST, "reserva");
$lista = filter_input(INPUT_POST, "lista");
$utensilio = filter_input(INPUT_POST, "utensilio");
$date = filter_input(INPUT_POST, "date");
$date = str_replace("/", "-", $date);
$data =  date('Y/m/d', strtotime($date));
$time = filter_input(INPUT_POST, "time");
$n_cvdd = filter_input(INPUT_POST, "n_cvdd");
$obs = filter_input(INPUT_POST, "obs");
$today = date('y-m-d H:i');
$status = 1;
$motivo = filter_input(INPUT_POST, "motivo");
$id = filter_input(INPUT_POST, "id");

$type = filter_input(INPUT_POST, "type");

if ($type == "register") {

  if (isset($_SESSION['username'])) {

    if ($condominoDAO->findCondomino($nomeCondomino)) {

      $id_cond = $condominoDAO->findCondomino($nomeCondomino);

      $nome = $id_cond->id;

      $event = new Event;

      $event->id_cond = $nome;
      $event->id_user = $_SESSION['username'];
      $event->reserva = $reserva;
      $event->lista = $lista;
      $event->utensilios = $utensilio;
      $event->data = $data;
      $event->hora = $time;
      $event->n_cvdd = $n_cvdd;
      $event->obs = $obs;
      $event->data_cad = $today;
      $event->status = $status;

      $result = $newEvent->createEvent($event);        

      if ($result) {

        $message->setMessage("Reserva Efetuada com Sucesso! $nomeCondomino $date", "success", "index.php");
      } else {

        $message->setMessage("Infelizmente, algo deu errado. Tente de novo, ou procure o desenvolvedor.", "error", "index.php");
      }
    } else {

      $message->setMessage("Nome do morador inválido. O nome deve estar previamente cadastrado.", "error", 'index.php');
    }
  } else {

    $message->setMessage("Você precisa estar logado para fazer essa operação", "error", 'index.php');
  }
} else if ($type == "update") {

  $event = new Event;

  $event->id = $id;
  $event->reserva = $reserva;
  $event->lista = $lista;
  $event->utensilios = $utensilio;
  $event->hora = $time;
  $event->n_cvdd = $n_cvdd;
  $event->obs = $obs;
  $event->alter_user = $_SESSION['username'];
  $event->alter_date = $today;

  $checkEvent = $newEvent->updateEvent($event);

  if ($checkEvent) {

    $message->setMessage("Reserva $id atualizada!", "success", "index.php");
  } else {

    $message->setMessage("$checkEvent Erro ao atualizar reserva $id!", "error", "index.php");
  }
} else if ($type == "cancel") {

  $status = 2;

  $event = new Event;

  $event->id = $id;
  $event->status = $status;
  $event->cancel_user = $_SESSION['username'];
  $event->cancel_date = $today;
  $event->motivo = $motivo;

  $checkEvent = $newEvent->cancelEvent($event);

  if ($checkEvent) {
    $message->setMessage("Reserva $id cancelada com sucesso!", "success", "eventlist.php?status=1");
  } else {
    $message->setMessage("Erro ao cancelar reserva &id", "error", "eventlist.php?status=1");
  }
}
