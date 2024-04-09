<?php
include_once("config/db.php");
include_once("dao/condominoDAO.php");

$condomino = new CondominoDAO($conn, $BASE_URL);
$busca = filter_input(INPUT_POST, 'nome');

echo $condomino->getCondominos($busca);