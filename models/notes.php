<?php

include_once "models/condomino.php";

  class Note extends condomino{

    public $id;
    public $id_cond;
    public $id_user;
    public $categoria;
    public $prioridade;
    public $recado;
    public $data_cad;
    public $data_exp;
    public $alter_user;
    public $alter_date;
    public $concluir;
    public $date_conc;
    public $conc_user;
    public $motivo_conc;
    public $color;

    public function selectColor($prioridade)
    {

      if($prioridade == "Normal"){
          $color = "#e14eca";
      }else if($prioridade == "Alta"){
          $color = "#a5a509";
      }else if($prioridade == "Urgente"){
          $color = "red";
      }

      return $color;
    }

    public function issetNote($note){

      if(isset($note)){
        echo $note;
      }else{
        $note = "";
      }
    }

  }

 interface NoteDAOinterface{

  public function buildNote($data);
  public function createNote(Note $note);
  public function updateNote(Note $note, $concluir);
  public function concludeNote($concluirRecado);
  public function getNote($concluir, $pagina);
  public function getNoteByCs($pagina, $casa);
  public function getNoteById($id);
  public function paginationNote($pagina, $concluir, $casa);  

}