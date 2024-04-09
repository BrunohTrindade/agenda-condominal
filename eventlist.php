<?php

  include_once("templates/header.php");

  include_once("dao/eventsDAO.php");
  
  $events = new eventsDAO($conn, $BASE_URL);
  $event = new event;
  $status = $_GET['status'];
  if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
  }else{
    $pagina = 1;
  }

  if(isset($_GET['start']) || (isset($_GET['start'] )!="")){
    $start = $_GET['start'];
    $end = $_GET['end'];
  }else{
    $start = false;
    $end =false;
  }

  if(isset($_GET['reserva'])){
    $reserva = "#".$_GET['reserva'];
  }else{
    $reserva = false;
  }

  if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];
    $data = $events->getEventsListById($id);
  }else{
    $id = false;
    $data = $events->getEventsList($status, $pagina, $reserva, $start, $end, $id);
  }
  
  if($data == false){
    $noResult = "não há registros";
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
        <div class="row">
          <div class="col-md-8">
            <div class="card ">
              <div class="card-header">
                <nav class="navbar navbar-expand-lg navbar-min bg-white">
                  <div class="container text-white">
                    <span class="navbar-text text-center selected">
                        Reservas <?php echo $event->selectColorEvent($reserva);?>
                    </span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" style="font-weight: 200px!important" href="eventlist.php?status=1">Reservas<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="eventlist.php?reserva=4da751&status=1">Churrasqueira</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="eventlist.php?reserva=10b7cc&status=1">Salão</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="eventlist.php?status=2">Cancelados</a>
                        </li>
                      </ul>                     
                    </div>
                  </div>
                </nav>
              </div>
              <table class="table tablesorter">
                <thead>
                    <tr>
                        <th class="text-center text-primary">ID</th>
                        <th>Nome</th>
                        <th>Reserva</th>
                        <th>Data</th>
                        <th class="text-right">Hora</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>            
                <tbody>
                  <?php if($data != false): foreach($data as $event): ?>
                    <tr>
                        <td class="text-center text-success"><?php echo $event->id;?></td>
                        <td><?php echo utf8_decode(ucwords(strtolower(mb_strimwidth($event->id_cond, 0, 20,"..."))));?></td>
                        <td><?php echo $event->reserva;?></td>
                        <td><?php echo date('d/m/y',strtotime($event->data));?></td>
                        <td class="text-right"><?php echo date('H:i',strtotime($event->hora));?></td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm" data-toggle="modal" data-target="#modalView<?= $event->id;?>">
                                <i class="tim-icons icon-single-02"></i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm" data-toggle="modal" data-target="#modalConclude<?= $event->id;?>">
                                <i class="tim-icons icon-settings"></i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm" data-toggle="modal" data-target="#modalCancel<?= $event->id;?>">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                    require("templates/modals/eventListModals.php");
                      endforeach;?>
                   <div class="text-success" style="text-color: red!important;"> <?php else: echo $noResult;
                    endif ;
                    ?></div>
                </tbody>
              </table>
            </div>
              <div class="nav text-center">
              <ul class="pagination justify-content-center ">
              <?= $events->paginationEvents($pagina, $status, $reserva, $start, $end); ?>
              </ul>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      
                      <h5 class="title"><i class="tim-icons icon-zoom-split text-primary" ></i> Pesquisar por:</h5>
                    </a>
                    <!-- <p class="description">
                      Ceo/Co-Founder
                    </p> -->
                  </div>
                </p>
                <div class="card-description">
                <form method="GET" autocomplete="off">                  
                    <div class="col-md-12 text-center">
                      <div class="form-group text-center">
                        <label>ID</label>
                        <input type="text" class="form-control" id="id" name="id" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                      </div>
                    </div>
                    <div class="col-md-12 text-center text-success">
                      <div class="form-group">
                        ou
                        
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <div class="form-group">
                        <label>Data inicial</label>
                        <input type="date" class="form-control" id="start" name="start">
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <div class="form-group">
                        <label>Data final</label>
                        <input type="date" class="form-control" id="end" name="end">
                        <input type="hidden" class="form-control" id="status" name="status" value="1">
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
              <div class="card-footer">
                <div class="button-container">
                  <button type="submit" class="btn btn-success"><i class="tim-icons icon-zoom-split"></i></button>  
                </form>               
                </div>
              </div>
            </div>
          </div>
        </div>

          <script src="assets/js/custom.js"></script>
        <?php include_once("templates/footer.php");?>
