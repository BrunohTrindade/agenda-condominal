<?php
include_once("config/db.php");
include_once("dao/condominoDAO.php");

$condomino = new CondominoDAO($conn, $BASE_URL);
$assunto = filter_input(INPUT_GET, 'term');

echo ucwords(strtolower($condomino->getEvents2($assunto)));
