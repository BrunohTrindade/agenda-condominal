<?php
include_once "models/user.php";
  Class Event extends User {

    public $id;
    public $id_cond;
    public $reserva;
    public $lista;
    public $utensilios;
    public $data;
    public $hora;
    public $n_cvdd;
    public $obs;
    public $data_cad;
    public $usuario;
    public $status;
    public $alter_user;
    public $alter_date;
    public $cancel_user;
    public $cancel_date;
    public $motivo;

    public function selectColorEvent($reserva)
    {
      if($reserva == '#4da751'){
        $reserva = 'Churrasqueira';
      }else if( $reserva == '#10b7cc'){
        $reserva = 'Salão';
      }else if($reserva == '#000000'){
        $reserva = 'Não Reservar';
      }

      return $reserva;
    }

    public function selectColorType($color)
    {



    }

  }

  interface eventsDAOinterface{
    
    public function buildEvents($data);
    public function createEvent(Event $event);
    public function updateEvent(Event $event);
    public function cancelEvent($event);
    public function getEvents();
    public function getEventsById($id);
    public function paginationEvents($status, $pagina, $reserva, $start, $end);
  }

  ?>