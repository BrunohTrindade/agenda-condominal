<?php

  include_once("templates/header.php");

  if(isset($_GET['id'])){ 

  include_once("dao/eventsDAO.php");
  
  $id = filter_input(INPUT_GET, 'id');
  $event = new eventsDAO($conn, $BASE_URL);
  $data = $event->getEventsById($id);

  if($data == false){
    header("Location: $BASE_URL");
  }

  }
  elseif(isset($_GET['date'])){ 

    $date = filter_input(INPUT_GET, 'date');
  }
?>

</head>

<body class="">
  <div class="wrapper">
    <?php include_once("templates/sidebar.php"); ?> 
    <div class="main-panel">
      
      <?php include_once("templates/navbar.php"); ?> 
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="PESQUISAR RECADOS POR CASA">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="content">
          <div class="row">
            
            <?php if(isset($_GET['date']) || isset($_GET['id'])) : ?>
              <div class="col-md-8 ml-auto mr-auto">
              <div class="card card-chart fade-in">
                <div class="card-header text-center">
                  <h3 class="card-title"><i class="tim-icons icon-paper text-primary"></i> 
                    <?php if(isset($_GET['id'])): echo ucwords(strtolower($data->reserva))." <span class='text-success' style='font-size: 14px;'>#".$data->id.'</span>'; ?>

                    <?php else: ?>
                      Nova Reserva!
                    <?php endif ?>
                   
                    <small class="text-success" style="font-size: 12px;"> 
                    </small>
                  </h3>
                </div>
                <div class="card-body">
                  <div class="container">
                    <form method="POST" action="events_process.php" autocomplete="off" onsubmit="return check_form()">
                        <input type="hidden" name="type" id="type" value="register">
                        <div class="form-row">
                          <div class="form-group text-center col-md-12" >
                            <label for="inputAddress " >Nome do Condômno</label>
                            <?php if(isset($_GET['id'])):?>
                              <input type="hidden" name="type" id="type" value="update">
                              <input type="hidden" name="id" id="id" value="<?php echo $data->id;?>">
                              <input type="text" class="form-control required text-success text-center id_cond" id="id_cond" name="id_cond"  value="<?php echo ucwords(strtolower($data->id_cond));?>"
                              disabled >
                            <?php else:?>
                              <input type="hidden" name="type" id="type" value="register">
                            <input type="text" class="form-control required text-success text-center" id="id_cond" name="id_cond"  value="">
                            <?php endif;?>
                          </div>
                          <!--<div class="form-group text-center col-md-1" >
                          <label for="inputAddress " >Add</label>
                          <a class="btn btn-primary btn-simple btn-sm" data-toggle="modal" data-target="#addCondomino">+</a>
                          </div>-->
                        </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="exampleFormControlSelect1">Reserva</label>
                          <select class="form-control" id="reserva" name="reserva" required>
                          <?php if(isset($_GET['id'] )): ?>
                          <option class="grayText" style="background-color: #cd23b2; color:#fff!important"  selected="selected" value="#4da751" required><?= $data->reserva; ?></option>
                          <?php endif ?>
                          <option class="grayText" value="#4da751"> Churrasqueira </option>
                          <option class="grayText"   value="#10b7cc" >Salão</option>
                          <option class="grayText" value="#000000" >Não reservar</option>
                          </select>
                        </div> 
                                             
                        <label for="inputEmail4">Lista</label>
                        <div class="form-check form-check-radio form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="lista" id="lista" value="SIM"
                            <?php if(isset($_GET['id']) && isset($data->lista) && $data->lista == 'SIM'){ echo "checked";}?>> Sim
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                        <div class="form-check form-check-radio form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="lista" id="lista" value="NÃO" 
                            <?php if(isset($_GET['id']) && isset($data->lista) && $data->lista == 'NÃO'){ echo "checked";}?>> Não
                            <span class="form-check-sign"></span>
                          </label>
                        </div>                        
                        <div class="form-group col-md-4">
                          <label for="exampleFormControlSelect1">Utensilios</label>
                          <select class="form-control required" id="utensilio" name="utensilio" required>
                            <?php if(isset($_GET['id'] )): ?>
                          <option class="grayText" style="background-color: #cd23b2; color:#fff!important" value="<?= $data->utensilios; ?>" selected="selected"><?= $data->utensilios; ?></option>
                            <?php endif ?>
                          <option class="grayText" value="Sem utensilios" >Sem utensilios</option>                            
                          <option class="grayText"   value="Somente copos" >Somente copos</option>
                          <option class="grayText" value="Kit Churrasco" >Kit Churrasco</option>
                          <option class="grayText" value="Jogo completo" >Jogo completo</option>
                          </select>
                        </div>   
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputEmail4">Dia</label>
                          <?php if(isset($_GET['id'])):?>
                          <input type="text" class="form-control required text-primary" rel='tooltip'  name="date" id="date" value="<?php echo date('d/m/Y',strtotime($data->data)); ?>" disabled>
                          <?php elseif(isset($_GET['date'])): ?>
                            <input type="text" class="form-control required text-primary" id="date" name="date"  value="<?php echo date('d/m/Y',strtotime($date));?>">
                          <?php endif;?>       
                        </div>                                                      
                        <div class="form-group col-md-4">
                          <label for="inputPassword4">Horário</label>
                          <input type="time" class="form-control required grayText" id="time" name="time"  min="06:00" max="22:00" <?php if(isset($_GET['id'])):?>value="<?php echo $data->hora; endif?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPassword4">Nº de convidados</label>
                          <input type="text" class="form-control required" id="n_cvdd" name="n_cvdd" onkeypress="return event.charCode >= 48 && event.charCode <= 57"<?php if(isset($_GET['id'])):?>value="<?php echo $data->n_cvdd; endif?>">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observações</label>
                        <textarea class="form-control" style="font-size: 13px;" id="obs" name="obs" rows="3"> <?php if(isset($_GET['id'])):?><?php echo strtoupper($data->obs); ?><?php endif?></textarea>
                      </div>
                      <div class="form-group text-center">
                      <a href="<?= $BASE_URL?>" class="btn btn-danger btn-sm">Cencelar</a>
                      <button type="submit" class="btn btn-success btn-sm">
                        <?php if(isset($_GET['id'])): ?>                      
                           Atualizar
                        <?php else: ?>
                          Salvar
                        <?php endif ?>                        
                      </button>                     
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php endif?>
          </div>
          <div class="modal modal-black show fade bd-example-modal-sm" id="addCondomino" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;"> </span></h5>
              </div>
              <div class="modal-body">
                <form action="condomino_process.php" method="POST">
                  <input type="hidden" name="type" value="addCondomino">
                  <div class="form-row">
                    <div class="col-md-10">
                      <label for="exampleInputPassword1">Nome Condômino</label>
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo do comdomino" required onkeyup="validarSenha()">
                      <div id="erroSenha"></div>
                    </div>
                    <div class="col-md-2">
                      <label for="exampleInputPassword1">Casa</label>
                      <input type="text" class="form-control" id="casa" name="casa" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
                      <div id="confirm_pass"></div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"> Salvar</button>
                </form>
              </div>
              </div>
            </div>
          </div>
          <!-- FullCalendar -->
          <div class="row" >
            <div class="col-md-12 ml-auto mr-auto" >
              <div class="card fade-in-right" >
                <div class="card-body" style="color: #fff" >
                  <div class="table-responsive" >
                    <div id="calendar"style="max-height: 500px!important;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End FullCalendar -->
      </div>
      <!-- Footer -->
      <?php include_once("templates/footer.php");