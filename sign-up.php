<?php
include_once ("config/globals.php");
include_once ("models/message.php");

$message = new Message($BASE_URL);

$flashmessage = $message->getMessage();

if(isset($_SESSION['username'])){
  header("location: index.php");
}

if(!empty($flashmessage['msg'])){
  $message->clearMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
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
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <div class="main-panel">
      <div class="content">
        <div class="row">
        <div class="col-md-2">
          </div>
          <div class="col-md-4">
            <div class="card card-user fade-in">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar" src="assets/img/tucanos.png" alt="...">
                      <h5 class="title">C O N D O M I N I O &nbsp&nbsp T U C A N O S</h5>
                    </a>
                    <p class="description">
                      <?php if(isset($flashmessage['msg'])):?>
                        <div class="alert alert-danger">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                              <i class="tim-icons icon-simple-remove"></i>
                            </button>
                            <span><?= $flashmessage['msg']; ?></span>
                        </div>
                      <?php endif ?>
                    </p>
                  </div>
                </p>
                <div class="card-description">
                <form action="auth_process.php" method="POST" autocomplete="off">
                 <input type="hidden" name="type" value="register">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome </label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nome" require>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome de usuario<span class="text-primary"> * será seu login * </span></label>
                      <input type="text" class="form-control" name="name_user" id="name_user" placeholder="Nome de usuario" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" require>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Senha</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required onkeyup="validarSenha()">
                      <div id="erroSenha"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirmar Senha</label>
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha" required onkeyup="validarSenhas()">
                      <div id="confirm_pass"></div>
                    </div>
                   
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-success">Cadastrar</button><br>
                      <label> <a href= "<?= $BASE_URL ?>sign-in.php">Já tenho conta!</a>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          </div>
        </div>
      </div>
<?php

include_once("templates/footer.php");

?>