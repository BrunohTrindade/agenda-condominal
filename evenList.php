<?php

include_once("dao/eventsdao.php");
include_once("config/db.php");

$eventos = new eventsDAO($conn, $BASE_URL);
echo $eventos->getEvents();
?>