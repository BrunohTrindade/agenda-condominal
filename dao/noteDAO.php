<?php

require_once ("config/globals.php");
require_once ("config/db.php");
include_once("models/notes.php");
require_once ("models/condomino.php");
require_once ("models/message.php");



Class NoteDAO implements NoteDAOinterface
  {

    private $conn;
    private $msg;
    private $url;

    public function __construct(PDO $conn, $url){

      $this->conn = $conn;
      $this->url = $url;
    }

    public function qnt_result_pg(){
      $qnt_result_pg = 9;

      return $qnt_result_pg;
    }

    public function buildNote($data)
    {

      $note = new Note();

      $note->id = $data['id'];
      $note->id_cond = $data['nome'];
      $note->casa = $data['casa'];
      $note->id_user = $data['usuario'];
      $note->categoria = $data['categoria'];
      $note->prioridade = $data['prioridade'];
      $note->recado = $data['recado'];
      $note->data_cad = $data['data_cad'];
      $note->data_exp = $data['data_exp'];
      $note->alter_user = $data['alter_user'];
      $note->alter_date = $data['alter_date'];
      $note->concluir = $data['concluir'];
      $note->date_conc = $data['date_conc'];
      $note->conc_user = $data['conc_user'];

      return $note;

    }

    public function createNote($data)
    {
      $concluir = 0;
      $stmt = $this->conn->prepare("INSERT INTO recado (id_cond, usuario, categoria, prioridade, recado, data_exp, data_cad, concluir ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bindParam(1, $data->id_cond);
      $stmt->bindParam(2, $data->id_user);
      $stmt->bindParam(3, $data->categoria);
      $stmt->bindParam(4, $data->prioridade);
      $stmt->bindParam(5, $data->recado);
      $stmt->bindParam(6, $data->data_exp);
      $stmt->bindParam(7, $data->data_cad);
      $stmt->bindParam(8, $concluir);
      $stmt->execute();
      
      if($stmt->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
     
    }

    public function updateNote($note, $concluir){

      $stmt = $this->conn->prepare("UPDATE recado SET
      categoria = :categoria,
      prioridade = :prioridade,
      data_exp = :data_exp,
      recado = :recado,
      alter_user = :alter_user,
      alter_date = :alter_date
      WHERE id = :id");

      $stmt->bindParam(":categoria", $note->categoria);
      $stmt->bindParam(":prioridade",$note->prioridade);
      $stmt->bindParam(":data_exp",$note->data_exp);
      $stmt->bindParam(":recado",$note->recado);
      $stmt->bindParam(":alter_user",$note->alter_user);
      $stmt->bindParam(":alter_date",$note->alter_date);
      $stmt->bindParam(":id",$note->id);
      $stmt->execute();

      if($stmt->rowCount() > 0){
        return true;
      }else{
        return false;
      }

    }

    public function concludeNote($concluirRecado){

      $concluir = 1;
      $stmt = $this->conn->prepare("UPDATE recado SET 
      conc_user = :conc_user,
      date_conc = :date_conc,
      concluir = :concluir,
      motivo_conc = :motivo_conc
      WHERE id = :id AND data_exp < current_DATE() AND conc_user IS NULL");

      $stmt->bindParam(":conc_user", $concluirRecado->conc_user);
      $stmt->bindParam(":date_conc", $concluirRecado->date_conc);
      $stmt->bindParam(":concluir", $concluir);
      $stmt->bindParam(":motivo_conc", $concluirRecado->motivo_conc);
      $stmt->bindParam(":id", $concluirRecado->id);

      $stmt->execute();

      if($stmt->rowCount() > 0){
        return true;
      }else{
        return false;
      }

    }

    public function getNote($concluir, $pagina)
    {
        $notes = [];

        $qnt_result_pg = $this->qnt_result_pg();
        $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

        $stmt = $this->conn->prepare("SELECT * FROM recado
                                    left JOIN condominos
                                    ON recado.id_cond = condominos.id_condominos 
                                    left JOIN funcionario 
                                    ON recado.id_func = funcionario.id_func 
                                    WHERE concluir = :concluir 
                                    ORDER BY data_cad 
                                    DESC LIMIT :inicio, :qnt_result_pg ");
        $stmt->bindParam(":concluir", $concluir);
        $stmt->bindParam(":qnt_result_pg", $qnt_result_pg);
        $stmt->bindParam(":inicio", $inicio);
        $stmt->execute();
       
        if($stmt->rowCount() > 0){

          $noteArray = $stmt->fetchALL();

          foreach($noteArray as $note){
              $notes[] = $this->buildNote($note);
          }
        }
        return $notes;
    }

    public function getNoteByCs($pagina, $casa)
    {
        $notes = [];

        $qnt_result_pg = $this->qnt_result_pg();
        $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

        $stmt = $this->conn->prepare("SELECT * FROM recado
                                    left JOIN condominos
                                    ON recado.id_cond = condominos.id_condominos 
                                    left JOIN funcionario 
                                    ON recado.id_func = funcionario.id_func 
                                    WHERE casa = :casa 
                                    ORDER BY data_cad 
                                    DESC LIMIT :inicio, :qnt_result_pg ");
        $stmt->bindParam(":casa", $casa);
        $stmt->bindParam(":qnt_result_pg", $qnt_result_pg);
        $stmt->bindParam(":inicio", $inicio);
        $stmt->execute();
       
        if($stmt->rowCount() > 0){

          $noteArray = $stmt->fetchALL();

          foreach($noteArray as $note){
              $notes[] = $this->buildNote($note);
          }
        }
        return $notes;
    }

    public function getNoteById($id)
    {
      $stmt = $this->conn->prepare("SELECT * FROM recado 
                                    INNER JOIN condominos 
                                    ON recado.id_cond = condominos.id_condominos  
                                    WHERE id = :id");
      $stmt->bindParam(":id", $id);
      $stmt->execute();

      if($stmt->rowCount()> 0 )
      {

        $data = $stmt->fetch();
        $note = $this->buildNote($data); 

      }

      return $note;
    }

    public function getCategory($category){

      if($category == 'Aviso'){
        
        $category = "primary";        

      }else if($category == 'Autorização'){

        $category = "info";

      }else if($category == 'Proibição'){

        $category = "danger";      
      }

      return $category;
    }

    public function paginationNote($pagina, $concluir, $casa)
    {
      if($casa != "" ){
        $sql = "SELECT COUNT(id) AS result from recado 
                left JOIN condominos 
                ON recado.id_cond = condominos.id_condominos 
                left JOIN funcionario 
                ON recado.id_func = funcionario.id_func 
                WHERE casa = :concluir ";
      }else{
        $sql =  "SELECT COUNT(id) AS result from recado 
                left JOIN condominos 
                ON recado.id_cond = condominos.id_condominos 
                left JOIN funcionario 
                ON recado.id_func = funcionario.id_func 
                WHERE concluir = :concluir ";
      }


      $qnt_result_pg = $this->qnt_result_pg();

      
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':concluir', $concluir);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $value){
        $teste = $value['result'];       
      $quantidade_pg = ceil($value['result'] / $qnt_result_pg);
      }

      $html = "";
      //limitar qntdd de link
      $max_links = 1;

      if(!$concluir == 0){
        $concluir = "&conc=$concluir";
      }else{
        $concluir = "";
      }

      if($casa != ""){
        $casa = "&cs=$casa";
      }

      $html .= "<li class='pagination primary page-item'>
                  <a class='page-link' href='recados.php?pagina=1$concluir$casa' tabindex='-1'>
                    Primeira
                  </a>
                </li>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++)
    {
      if($pag_ant >=1)
      {
        $html .=  "<li class='pagination'>
                    <a class='page-link page-item' href='recados.php?pagina=$pag_ant$concluir$casa'>
                    $pag_ant
                    </a>
                  </li>";
      }
    }
    $html .=  " <li class='pagination active disable page-item'>
                  <a class='page-link'>
                  $pagina <span class='sr-only'>(current)</span>
                  </a>
                </li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++)
    {
      if($pag_dep <= $quantidade_pg){
        $html .=  " <li class='pagination'>
                      <a class='page-link page-item ' href='recados.php?pagina=$pag_dep$concluir$casa'> 
                      $pag_dep
                      </a>
                    </li>";
      }
    }

    $html .= "<li class='pagination page-item'>
                <a class='page-link' href='recados.php?pagina=$quantidade_pg$concluir$casa'>
                  Ultima
                </a>
              </li>";

    
    return $html;
    }

  }

  