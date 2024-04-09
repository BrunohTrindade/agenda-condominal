<div class="modal modal-black show fade bd-example-modal-sm" id="modalView<?php echo $event->id;?>" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;">Detalhes da reserva:
      <span class="text-primary text-center" style=" font-weight: 940;"><?php echo $event->reserva;?></span> </span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body "> 
      <div class=" text-white">
        <span class="text-success text-center">
          Para 
        </span>
        <?php echo ucwords(strtolower($event->id_cond)); ?> <bR>
        <span class="text-info text-center" style=" font-weight: 600;">
          Data: 
        </span>
          <?= date('d/m/Y',strtotime($event->data))." às ".date('H:i',strtotime($event->hora))." para ".$event->n_cvdd." convidados";?><br>
        <span class="text-warning text-center" style=" font-weight: 600;">
          Reservado por
        </span> <?= $event->usuario.". Dia: ".date('d/m/Y H:i',strtotime($event->data_cad))?><br>
        <?php if($event->alter_user != ""):?>
          <span class="text-danger text-center" style=" font-weight: 600;">
            Alterado por:
          </span>
          <?= $event->alter_user.". Dia: ".date('d/m/Y H:i',strtotime($event->alter_date))?>
        <?php endif;?>
        </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>     
    </div>
    </div>
  </div>
</div>

<!------- MODAL VIZUALIZAR/EDITAR ------->
<div class="modal fade modal-black bd-example-modal-lg" id="modalConclude<?php echo $event->id;?>" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
    <?= $event->id;?>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body">
    <form class="form-group" method="POST" action="events_process.php">
      <input type="hidden" name="type" id="type" value="register">
      <div class="form-group text-center">
          <input type="hidden" name="type" id="type" value="update">
          <input type="hidden" name="id" id="id" value="<?= $event->id;?>">
          <input type="text" class="form-control text-success text-center id_cond" id="id_cond" name="id_cond"  value="<?= ucwords(strtolower($event->id_cond));?>"
          disabled >                        
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">Reserva</label>
          <select class="form-control" id="reserva" name="reserva">
          <?php if($event->reserva): ?>
          <option class="grayText" style="background-color: #cd23b2; color:#fff!important" value="<?= $event->reserva; ?>" selected="selected"><?= $event->reserva; ?></option>
          <?php endif ?>
          <option class="grayText" value="#4da751"> Churrasqueira </option>
          <option class="grayText"   value="#10b7cc" >Salão</option>
          <option class="grayText" value="#000000" >Não reservar</option>
          </select>
        </div> 
                            
        <label for="inputEmail4">Lista</label>
        <div class="form-check form-check-radio form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="lista" id="lista" value="sim"
            <?php if(isset($event->lista) && $event->lista == 'SIM'){ echo "checked";}?>> Sim
            <span class="form-check-sign"></span>
          </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="lista" id="lista" value="nao" 
            <?php if(isset($event->lista) && $event->lista == 'NÃO'){ echo "checked";}?>> Não
            <span class="form-check-sign"></span>
          </label>
        </div>                        
        <div class="form-group col-md-12 ">
          <label for="exampleFormControlSelect1">Utensilios</label>
          <select class="form-control text-center" id="utensilio" name="utensilio" required>
          <option class="grayText" style="background-color: #cd23b2; color:#fff!important" value="<?= $event->utensilios; ?>" selected="selected"><?= $event->utensilios; ?></option>
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
          <input type="text" class="form-control text-primary" id="date" name="date"  value="<?= date('d/m/Y',strtotime($event->data));?>" disabled>
        </div>                                                      
        <div class="form-group col-md-4">
          <label for="inputPassword4">Horário</label>
          <input type="time" class="form-control grayText" id="time" name="time"  min="06:00" max="22:00" value="<?php echo $event->hora;?>">
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">Nº convidados</label>
          <input type="text" class="form-control" id="n_cvdd" name="n_cvdd" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $event->n_cvdd;?>">
          </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Observações</label>
        <textarea class="form-control" style="font-size: 13px;" id="obs" name="obs" rows="3"> <?php echo strtoupper($event->obs); ?></textarea>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success"> Atualizar</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!------- MODAL CANCELAR RESERVA ------->
<div class="modal modal-black show fade bd-example-modal-sm" id="modalCancel<?php echo $event->id;?>" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;">Deseja Cancelar? </span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body">
      <form class="group-form" method="POST" action="events_process.php">
      <input type="hidden" name="type" value="cancel">        
      <input type="hidden" name="id" id="id" value="<?php echo $event->id; ?>"> 
        Reserva  <span class="text-primary text-center" style=" font-weight: 940;"><?php echo $event->reserva;?></span> <?php echo $event->id;?><br>
        Para <span class="text-success text-center"><?php echo ucwords(strtolower($event->id_cond)); ?><bR>
      </span> Data: <?= date('d/m/Y',strtotime($event->data))?>
        <div class="form-group text-center col-md-12">
          <label for="inputAddress " ><small>Motivo:</small></label>
          <textarea class="form-control text-center text-success" id="motivo" name="motivo" required></textarea>
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