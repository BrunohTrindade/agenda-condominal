<?php

require_once("models/condomino.php");
require_once("config/globals.php");
require_once("config/db.php");

class CondominoDAO implements InterfaceCondominoDAO
{

  private $conn;
  private $url;


  public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
  }

  public function buildCondomino($data)
  {

    $condomino = new Condomino();

    $condomino->id = $data['id_condominos'];
    $condomino->nome = $data['nome'];
    $condomino->casa = $data['casa'];
    $condomino->status = $data['status'];

    return $condomino;
  }

  public function createCondomino($condomino)
  {
    $stmt = $this->conn->prepare("INSERT INTO condominos (nome, casa, morador) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $condomino->nome);
    $stmt->bindParam(2, $condomino->casa);
    $stmt->bindParam(3, $condomino->morador);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findCondomino($condomino)
  {
    $stmt = $this->conn->prepare("SELECT * FROM condominos WHERE nome = :condomino");
    $stmt->bindParam(":condomino", $condomino);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $data = $stmt->fetch();
      $condomino = $this->buildCondomino($data);

      return $condomino;
    } else {
      return false;
    }
  }

  public function findCondominoById($id)
  {

    $stmt = $this->conn->prepare("SELECT * FROM condominos WHERE id_condominos = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $data = $stmt->fetch();
      $condomino = $this->buildCondomino($data);

      return $condomino;
    } else {

      return false;
    }
  }

  public function getEvents2($term)
  {

    $stmt =  $this->conn->prepare("SELECT * FROM condominos WHERE nome LIKE :id_cond ORDER BY nome ASC LIMIT 7");
    $stmt->bindValue(":id_cond", '%' . $term . '%');
    $stmt->execute();
    while ($row_msg_cont = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $data[] = $row_msg_cont['nome'];
    }

    return json_encode($data);
  }

  public function getCondominos($data)
  {
    $status = 1;
    $query = "SELECT * FROM condominos WHERE nome LIKE '%" . $data . "%' AND morador = :status ORDER BY casa ";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":status", $status);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      $data = '<div class="table-responsive">
      <table class="table bordered">
      <tr>
        <th>Nome</th>
        <th>Casa</th>
        <th>Editar</th>
      </tr>
    ';
      foreach ($result as $row) {
        $array = array(
          "id" => $row["id_condominos"],
          "nome" => $row["nome"],
          "casa" => $row["casa"],
          "morador" => $row["morador"]
        );
        $this->modal($array);
        $data .= '
        <tr>
          <td>' . $row["nome"] . '</td>
          <td>' . $row["casa"] . '</td>
          <td>
            <a href="#" class="nav-link text-default" data-toggle="modal" data-target="#modalEdit' . $row['id_condominos'] . '" id="BtnmodalEdit">
              <i class="tim-icons icon-pencil text-success"></i>
            </a> 
          </td>
        </tr>
      ';
      }
      $data .= '</table></div>';
    } else {
      $data = "Nenhum registro localizado.";
    }

    echo $data;
  }

  public function modal($data)
  {

    if ($data['morador'] == 1) {
      $checked = "checked";
    } else {
      $checked = "";
    }
    $form = "'form'";
    $modal = '<div class="modal modal-black show fade bd-example-modal-sm" id="modalEdit' . $data['id'] . '" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;">EDITAR CONDÔMINO ' . $data['id'] . '</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <i class="tim-icons icon-simple-remove"></i>
                </button>
              </div>
              <div class="modal-body">
                <form action="condomino_process.php" method="POST" autocomplete="off" id="' . $data['id'] . '">
                  <input type="hidden" name="type" value="edit">        
                  <input type="hidden" name="id" id="id" value="' . $data['id'] . '"> 
                  <div class="form-row">
                    <div class="col-9">
                    <label>Nome</label>
                      <input class="form-control" name="nome" id="nome" type="text" value="' . $data['nome'] . '" />
                    </div>
                    <div class="col-3">
                    <label>Casa</label>
                      <input class="form-control" name="casa" id="casa" type="text" value="' . $data['casa'] . '" />
                     </div>
                  </div>
                  <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="morador" id="morador" value="1" ' . $checked . '> Morador
                        <span class="form-check-sign"></span>
                    </label>
                  </div>
                <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="morador" id="morador" value="0"> Ex-morador
                  <span class="form-check-sign"></span>
                </label>
                </div>              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                <a class="btn btn-success" href="#" onClick="document.getElementById(' . $data['id'] . ').submit();">ENVIAR</a>
                </form>
              </div>
            </div>
            </div>
          </div>';
    echo $modal;
  }

  public function EditCondomino($data)
  {
    $stmt = $this->conn->prepare("UPDATE condominos SET
  nome = :nome, 
  casa = :casa, 
  morador = :morador    
  WHERE id_condominos = :id");

    $stmt->bindParam(":nome", $data->nome);
    $stmt->bindParam(":casa", $data->casa);
    $stmt->bindParam(":morador", $data->morador);
    $stmt->bindParam(":id", $data->id);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
