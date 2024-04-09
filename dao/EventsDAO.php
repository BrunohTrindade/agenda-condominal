<?php
require_once("models/events.php");
require_once("dao/UserDAO.php");
require_once ("config/globals.php");
require_once ("config/db.php");



Class eventsDAO implements eventsDAOinterface{

  public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;      
    }

    public function qnt_result_pg()
    {
      $qnt_result_pg = 7;
      return $qnt_result_pg;
    }

  public function buildEvents($data)
  {
      $event = new Event();

      $reserva = $event->selectColorEvent($data['reserva']);

      $event->id = $data['id'];
      $event->id_cond = $data['nome'];
      $event->reserva = $reserva;
      $event->lista = $data['lista'];
      $event->utensilios = $data['uten'];
      $event->data = $data['dia'];
      $event->hora = $data['hora'];
      $event->n_cvdd = $data['n_cvdd'];
      $event->obs = $data['obs'];
      $event->data_cad = $data['data_cad'];
      $event->usuario = $data['usuario'];
      $event->status = $data['status'];
      $event->alter_user = $data['alter_user'];
      $event->alter_date = $data['alter_date'];
      $event->cancel_user = $data['cancel_user'];
      $event->cancel_date = $data['cancel_date'];
      $event->motivo = $data['motivo'];

      

      return $event;
  }

  public function createEvent(Event $event)
  {

     $stmt = $this->conn->prepare("INSERT INTO reservas 
                                  (id_cond, reserva, dia, n_cvdd, hora, uten, lista,
                                    obs, data_cad, usuario, status) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
     $stmt->bindParam(1, $event->id_cond);
     $stmt->bindParam(2, $event->reserva);
     $stmt->bindParam(3, $event->data);
     $stmt->bindParam(4, $event->n_cvdd);
     $stmt->bindParam(5, $event->hora);
     $stmt->bindParam(6, $event->utensilios);
     $stmt->bindParam(7, $event->lista);
     $stmt->bindParam(8, $event->obs);
     $stmt->bindParam(9, $event->data_cad);
     $stmt->bindParam(10, $event->id_user);
     $stmt->bindParam(11, $event->status);
     $stmt->execute();

     if($stmt->rowCount() > 0) {
      return true;
    }else{
      return false;
    }

  }
  
  public function updateEvent(Event $event)
  {

     $stmt = $this->conn->prepare("UPDATE reservas SET
     reserva = :reserva, 
     n_cvdd = :n_cvdd, 
     hora = :hora, 
     uten = :uten, 
     lista = :lista, 
     obs = :obs, 
     alter_user = :alter_user, 
     alter_date = :alter_date     
     WHERE id = :id");
     
     $stmt->bindParam(":reserva", $event->reserva);
     $stmt->bindParam(":n_cvdd", $event->n_cvdd);
     $stmt->bindParam(":hora", $event->hora);
     $stmt->bindParam(":uten", $event->utensilios);
     $stmt->bindParam(":lista", $event->lista);
     $stmt->bindParam(":obs", $event->obs);    
     $stmt->bindParam("alter_user", $event->alter_user);
     $stmt->bindParam("alter_date", $event->alter_date);
     $stmt->bindParam(":id", $event->id);
     
     $stmt->execute();

     if($stmt->rowCount() > 0) {
      return true;
    }else{
      return false;
    }

  }

  public function cancelEvent($event)
  {

    $stmt = $this->conn->prepare("UPDATE reservas SET
    status = :status,
    cancel_user = :cancel_user, 
    cancel_date = :cancel_date,
    motivo = :motivo   
    WHERE id = :id");

    $stmt->bindParam(":status", $event->status);  
    $stmt->bindParam(":cancel_user", $event->cancel_user);
    $stmt->bindParam(":cancel_date", $event->cancel_date);
    $stmt->bindParam(":motivo", $event->motivo);
    $stmt->bindParam(":id", $event->id);
    $stmt->execute();

    if($stmt->rowCount() > 0){
      return true;
    }else{
      return false;
    }

  }

    
  public function getEvents()
  {
    $status = 1;
    $stmt = $this->conn->prepare("SELECT id, nome as title, dia as start, reserva as color, obs as description FROM reservas INNER JOIN condominos ON reservas.id_cond = condominos.id_condominos  where status = :status");
    $stmt->bindParam(":status", $status);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($data, JSON_INVALID_UTF8_IGNORE);
  }
  
  public function getEventsById($id)
  {

    $status= 1;

    $stmt = $this->conn->prepare("SELECT * FROM reservas r JOIN condominos c ON r.id_cond= c.id_condominos WHERE status = :status and r.id = :id");
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    if( $stmt->rowCount() > 0)
    {
      $data = $stmt->fetch();
      $event = $this->buildEvents($data);
    }

  return $event;

  }

  public function getEventsListById($id)
  {

    $stmt = $this->conn->prepare("SELECT * FROM reservas r JOIN condominos c ON r.id_cond= c.id_condominos WHERE r.id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

   
    if($stmt->rowCount() > 0)
    {
     $events= [];
     $eventArray = $stmt->fetchAll();

     foreach($eventArray as $event)
     {  
        $events[] = $this->buildEvents($event);        
     }

     return $events;
    }

  }

  public function getEventsList($status, $pagina, $reserva, $start, $end)
  {
    $qnt_result_pg = $this->qnt_result_pg();
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

    if($start == false && $reserva == false)
    {
      $sql =  "SELECT * FROM reservas 
                INNER JOIN condominos 
                ON reservas.id_cond = condominos.id_condominos  
                WHERE status = :status
                ORDER BY data_cad 
                DESC LIMIT :inicio, :qnt_result_pg";
    }

    if($reserva && $start == false)
    {
      $sql =  "SELECT * FROM reservas 
                INNER JOIN condominos 
                ON reservas.id_cond = condominos.id_condominos  
                WHERE status = :status
                AND reserva = :reserva
                ORDER BY data_cad 
                DESC LIMIT :inicio, :qnt_result_pg";
    }

    if($start && $reserva == false){
      $sql =  "SELECT * FROM reservas 
                INNER JOIN condominos 
                ON reservas.id_cond = condominos.id_condominos  
                WHERE status = :status 
                AND dia BETWEEN :start AND :end
                ORDER BY data_cad 
                DESC LIMIT :inicio, :qnt_result_pg";
    }

    
    $stmt = $this->conn->prepare($sql);
    
      $stmt->bindParam(":status", $status);
      $stmt->bindParam(":inicio", $inicio);
      $stmt->bindParam(":qnt_result_pg", $qnt_result_pg);


    if($start != false){
      $stmt->bindParam(":start", $start);
      $stmt->bindParam(":end", $end);
    }

    if($reserva != false){
      $stmt->bindParam(":reserva", $reserva);
    }
    
    $stmt->execute();

    if($stmt->rowCount() > 0)
    {
     $events= [];
     $eventArray = $stmt->fetchAll();

     foreach($eventArray as $event)
     {  
        $events[] = $this->buildEvents($event);        
     }

     return $events;

    }else{
      return false;
    }

  }

  public function paginationEvents($pagina, $status, $reserva, $start, $end)
  {

    $qnt_result_pg = $this->qnt_result_pg();

    if($start == false && $reserva == false)
    {
      $sql =  "SELECT COUNT(id) AS result FROM reservas 
            INNER JOIN condominos 
            ON reservas.id_cond = condominos.id_condominos  
            WHERE status = :status";

            $var_start = "";
            $var_end = "";
            $var_reserva = "";
    }

    if($reserva && $start == false)
    {
      $sql =  "SELECT COUNT(id) AS result FROM reservas 
                INNER JOIN condominos 
                ON reservas.id_cond = condominos.id_condominos  
                WHERE status = :status
                AND reserva = :reserva";

      $res="&reserva=$reserva";
      $var_reserva = preg_replace('/[#\@\.\;\" "]+/', '', $res);
      $var_start = "";
      $var_end = "";

    }

    if($start && $reserva == false){
      $sql =  "SELECT COUNT(id) AS result FROM reservas 
            INNER JOIN condominos 
            ON reservas.id_cond = condominos.id_condominos  
            WHERE status = :status AND dia BETWEEN :start AND :end";

      $var_start = "&start=$start";
      $var_end = "&end=$end";
      $var_reserva = "";
    }
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    if($start != false){
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    }
    if($reserva != false){
      $stmt->bindParam(":reserva", $reserva);
    }
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $value){
      $teste = $value['result'];       
    $quantidade_pg = ceil($value['result'] / $qnt_result_pg);
    }

    $var_status = "&status=$status";
    $html = "";
    //limitar qntdd de link
    $max_links = 1;
    $html .= "<li class='pagination primary page-item'>
                <a class='page-link' href='eventlist.php?pagina=1$var_status$var_start$var_end$var_reserva' tabindex='-1'>
                  Primeira
                </a>
              </li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++)
    {
      if($pag_ant >=1)
      {
        $html .= "<li class='pagination'>
                    <a class='page-link page-item' href='eventlist.php?pagina=$pag_ant$var_status$var_start$var_end$var_reserva'>
                      $pag_ant
                    </a>
                  </li>";
      }
    }
    $html .=    "<li class='pagination active disable page-item'>
                    <a class='page-link'>
                      $pagina <span class='sr-only'>(current)</span>
                    </a>
                 </li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++)
    {
      if($pag_dep <= $quantidade_pg){
        $html .=  " <li class='pagination'>
                      <a class='page-link page-item ' href='eventlist.php?pagina=$pag_dep$var_status$var_start$var_end$var_reserva'> 
                        $pag_dep
                      </a>
                    </li>";
      }
    }

    $html .=  " <li class='pagination page-item'>
                  <a class='page-link' href='eventlist.php?pagina=$quantidade_pg$var_status$var_start$var_end$var_reserva'>
                    Ultima
                  </a>
                </li>";
  
    return $html;
  }
}