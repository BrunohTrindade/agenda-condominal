<?php

  include_once("config/db.php");
  include_once("config/globals.php");
  include_once("models/message.php");
  include_once("dao/UserDAO.php");
  include_once("dao/NoteDAO.php");


$message = new Message($BASE_URL);

$flashmessage = $message->getMessage();

if(!empty($flashmessage['msg'])){
  $message->clearMessage();
}

if(isset($_SESSION['username'])){

  $userDAO = new UserDAO($conn, $BASE_URL);
  $username = $_SESSION['username'];
  $user = $userDAO->findByUser($username);

}else{
  header("location: sign-in.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    CONDOMINIO TUCANOS
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />  
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- fullcalendar -->
  <link href='lib/main.min.css' rel='stylesheet'/>
</head>