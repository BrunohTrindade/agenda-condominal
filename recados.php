<?php

  include_once("templates/header.php");

  $notes = new NoteDAO($conn, $BASE_URL);
  $concluirRecado = new Note;
  
  if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
  }else{
    $pagina = 1;
  }

  if(isset($_GET['conc'])){
    $concluir = 1;
  }else{
    $concluir  = 0;
  }
    
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data = $notes->getNoteById($id);

    echo $data->id_cond;
  }elseif(isset($_GET['cs'])){

    $casa = $_GET['cs'];
    $data = $notes->getNoteByCs($pagina, $casa);
    
  }else{
    $data = $notes->getNote($concluir, $pagina);
    $casa = "";
  }

?>
</head>

<body class="">
  <div class="wrapper">
    <?php include_once("templates/sidebar.php"); ?> 
    <div class="main-panel">
      <!-- Navbar -->
      <?php include_once("templates/navbar.php"); ?> 
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
        <nav class="navbar navbar-expand-lg  navbar-min bg-success">
          <div class="container">            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarText">
              <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                <a href="#" class="nav-link text-default" data-toggle="modal" data-target="#modalCreate" id="BtnmodalEdit">
                  <i class="tim-icons icon-pencil text-success"></i>
                  + Recado <span class="sr-only">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-default" href="recados.php?">Recados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-default" href="recados.php?conc=1">Concluídos</a>
                </li>
              </ul>              
              <form class="form-inline ml-auto" method="GET">
                <div class="form-group no-border">
                  <input type="text" class="form-control" name="cs" placeholder="Casa">
                </div>
                <button type="submit" class="btn btn-link btn-icon btn-round">
                    <i class="tim-icons icon-zoom-split"></i>
                </button>
              </form>            
            </div>
          </div>
        </nav><br>
        <!----------- RECADOS ----------->
        <div class="row"> 
          <?php if(isset($data)): ?>
          
            <?php foreach($data as $note):
              $color = new Note;
              
              $changeColor = $color->selectColor($note->prioridade);

            ?>
              <?php require("templates/modals/recadosModels.php");?>

            <?php endforeach;?>
            
          <?php endif;?>    
         
        </div>
        
        <div class="nav text-center">
          <ul class="pagination justify-content-center ">
          <?php 
            echo $notes->paginationNote($pagina, $concluir, $casa);
          ?>
          </ul>
        </div>
      
        <?php include_once("templates/footer.php");
