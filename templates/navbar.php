<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle d-inline">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <a class="navbar-brand" href="javascript:void(0)">CONDOMINIO TUCANOS</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav ml-auto">       
        <li class="nav-item text-white">
           <a class="nav-link ">Olá, <?php if(isset( $_SESSION['username'])){ echo  $_SESSION['username']; } ?></a>
        </li>
        <li class="dropdown nav-item">
          <a class="dropdown-toggle nav-link" data-toggle="dropdown">
            <div class="photo">
              <img src="assets/img/tucanos.png" alt="Profile Photo">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-navbar">
            <li class="nav-link"><a class="nav-item dropdown-item text-info" data-toggle="modal" data-target="#changePass">Trocar Senha</a></li>
            <li class="nav-link"><a href="<?= $BASE_URL ?>teste.php" class="nav-item dropdown-item text-info">Sair</a></li>
          </ul>
        </li>
        <li class="separator d-lg-none"></li>
      </ul>
    </div>
  </div>
</nav>

<div class="modal modal-black show fade bd-example-modal-sm" id="changePass" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;"> </span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body">
      <form action="auth_process.php" method="POST">
        <input type="hidden" name="type" value="changePassword">
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
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
      <button type="submit" class="btn btn-success"> Sim</button>
      </form>
    </div>
    </div>
  </div>
</div>