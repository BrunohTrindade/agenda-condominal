<?php

class Condomino{

  public $id;
  public $nome;
  public $casa;
  public $morador;
  public $status;
}

interface InterfaceCondominoDAO{

  public function buildCondomino($data);
  public function createCondomino($nome);
  public function findCondomino($condomino);
  public function findCondominoById($id);

}