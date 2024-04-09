<?php
// Cria ma variavel com a data/hora atual
$now = new DateTime();
$datetime = $now->format('Y-m-d H:i:s');

// Define $novo como hora atual +16hrs para frente
  // Ao qual é o tempo em que a mensagem NOVO deverá ser apresentada.
$novo = date('Y-m-d H:i:s', strtotime('+16 hour', strtotime($note->data_cad)));


$id = $note->id;

// Verifica se a data de expiração é menor ou igual a data atual
  // e se o recado ja está concluido.
if($note->concluir == 0)  {

 $tempo = "tempo";
 $concluirRecado->id = $id;
 $concluirRecado->conc_user = $tempo;
 $concluirRecado->date_conc = $datetime;

 // atribui os valores na variavel e chama a função definindo o paramentro com os valores acima.
 $notes->concludeNote($concluirRecado);

}

?>
<div class="col-lg-4">
  <div class="card card-chart" style="min-height: 330px!important;">
  <!-- border-top: 1px solid <?php echo $changeColor;?> -->
    <div class="card-header block block-four">
      <div class="row">        
          <div class="block block-four"></div>
          <div class="col-lg-8">
            <h5 class="card-category">
              <span class="text-<?php echo $notes->getCategory($note->categoria);?>" style=" font-weight: 550;"> 
                <?php echo $note->categoria;?> 
              </span> 
              casa 
              <span class="text-success" style=" font-weight: 500;">
                <?php echo $note->casa;?>
              </span>              
                <?php echo date('d/m/y' ,strtotime($note->data_cad))."<small> id:".$note->id;?></small>              
            </h5>
          </div>
          <div class="col-lg-4 text-success pulsa">
          <?php
            // Verifica se $novo (que é hora autal + 16hrs) é maior igual a data atual
              // se for, imprime como recado NOVO
            if($novo >= $datetime){
              $nv = 'NOVO<br>';
              echo $nv;
            }            
            if(isset($note->conc_user)){
              $conc = 'CONCLUÍDO';
              echo "<small>".$conc."</small>";
            }            
          ?>
          </div>
      </div>
      <h4 class="card-title">
        <i class="tim-icons icon-bell-55 text-<?php echo $notes->getCategory($note->categoria);?>"></i> <?php echo $note->id_cond ;?> 
      </h4>
    </div>
    <div class="card-body " >    <h6 class="card-subtitle mb-2 text-muted">Recado: </h6>
      <p class="card-text" style="color: white!important;">
      <?php echo $note->recado; ?>      
      </p>
    </div>
    <div class="card-footer">
      <div class=" text-center">
        <?php  if(isset($note->conc_user)):?>        
          <?php else:?>
        <a href="#" class="card-link" data-toggle="modal" data-target="#modalEdit<?php $note->issetNote($note->id);?>">
          <i class="tim-icons icon-pencil text-success"></i>
        </a>
        <?php endif ?>
        <a href="#" class="card-link" data-toggle="modal" data-target="#modalView<?php $note->issetNote($note->id);?>">
          <i class="tim-icons icon-tv-2 text-success"></i> 
        </a>  
        <?php  if(isset($note->conc_user)):?>        
        <?php else:?>       
        <a href="#" class="card-link" data-toggle="modal" data-target="#modalConclude<?php $note->issetNote($note->id);?>">
          <i class="tim-icons icon-check-2 text-success"></i> 
        </a>        
        <?php endif?>
      </div>
    </div>
  </div>
</div>

<!------------------- EDITAR ------------------->

<div class="modal modal-black show fade " id="modalEdit<?php echo $note->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">  <i class="tim-icons icon-single-copy-04 text-primary"></i> Recado <?= $note->id ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
      </div>
      <div class="modal-body text-center">
        <form class="group-form" method="POST" action="note_process.php" autocomplete="off" onsubmit="return check_form()">
        <input type="hidden" name="type" id="type" value="update"> 
        <input type="hidden" name="id" id="id" value="<?php echo $note->id; ?>"> 
        <input type="hidden" name="concluir" id="concluir" value="<?php echo $note->concluir; ?>"> 
          <div class="form-row">
            <div class="form-group text-center col-md-8">
              <label for="inputAddress " ><small>Nome do Condômino</small></label>
              <input type="text" class="form-control text-center text-success" id="id_cond" id="id_cond" value= "<?php echo ucwords(strtolower($note->id_cond)); ?>" disabled>
            </div>
            <div class="form-group col-md-4"> 
              <label for="inputAddress " ><small>Tipo do recado:</small></label>                     
                  <select class="form-control" id="categoria" name="categoria">
                  <option class="grayText"   value="Autorização"  style="background-color: #cd23b2; color:#fff!important" selected="selected"><?php echo $note->categoria;?></option>
                  <option class="grayText"   value="Autorização" >Autorização</option>
                  <option class="grayText" value="Aviso" >Aviso</option>
                  <option class="grayText" value="Proibição" >Proibição</option>
                  </select>
              </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">                      
                <select class="form-control" id="prioridade" name="prioridade">
                <option class="grayText" value="<?php echo $note->prioridade; ?>" style="background-color: #cd23b2; color:#fff!important" selected="selected">Prioridade: <?php echo $note->prioridade;?></option>
                <option class="grayText" value="Normal" >Normal</option>
                <option class="grayText" value="Alta" >Alta</option>
                <option class="grayText" value="Urgente" >Urgente</option>
                </select>
            </div>
            <div class="form-group col-md-2">  
              <small>Expira em:</small> 
            </div>
            <div class="form-group col-md-4">
            <input type="date" class="form-control" rel='tooltip' title='Data de Expiração' name="data_exp" id="data_exp" required="" value="<?php echo $note->data_exp; ?>">
            </div>
          </div>
          <div class="form-group">
          <small><label for="exampleFormControlTextarea1"> Deixe o recado: </label></small>
            <textarea class="form-control" id="recado" name="recado" rows="3"><?php echo $note->recado;?></textarea>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!------------------- CRIAR ------------------->

<div class="modal modal-black show fade " id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">  <i class="tim-icons icon-single-copy-04 text-primary"></i> Novo Recado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="tim-icons icon-simple-remove"></i>
        </button>
      </div>
      <div class="modal-body text-center">
        <form method="POST" action="note_process.php" autocomplete="off" onsubmit="return check_form()">
        <input type="hidden" name="type" value="register"> 
          <div class="form-row">
            <div class="form-group text-center col-md-8">
              <label for="inputAddress " ><small>Nome do Condômino</small></label>
              <input type="text" class="form-control text-center text-success" id="id_cond1" name="id_cond" required>
            </div>
            <!--<div class="form-group text-center col-md-1" >
              <label for="inputAddress " ><small>Add</small></label>
              <a class="btn btn-primary btn-simple btn-sm" data-toggle="modal" data-target="#addCondomino">+</a>
            </div>-->
            <div class="form-group col-md-4"> 
              <label for="inputAddress " ><small>Tipo do recado:</small></label>                     
                  <select class="form-control " id="categoria" name="categoria" required>
                  <option class="grayText" value="Autorização" >Autorização</option>
                  <option class="grayText" value="Aviso" >Aviso</option>
                  <option class="grayText" value="Proibição" >Proibição</option>
                  </select>
              </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">                      
                <select class="form-control" id="prioridade" name="prioridade" required>
                <option class="grayText"   value="Normal"  disabled>Prioridade</option>
                <option class="grayText"   value="Normal" >Normal</option>
                <option class="grayText" value="Alta" >Alta</option>
                <option class="grayText" value="Urgente" >Urgente</option>
                </select>
            </div>
            <div class="form-group col-md-2">  
              <small>Expira em:</small> 
            </div>
            <div class="form-group col-md-4">       
            <input type="date" class="form-control " rel="tooltip" title="" name="data_exp" id="data_exp" data-original-title="Data de Expiração" 
            data-toggle="tooltip" data-placement="top" title="Tooltip on top" required>
            </div>
          </div>
          <div class="form-group">
          <small><label for="exampleFormControlTextarea1"> Deixe o recado: </label></small>
            <textarea class="form-control" id="recado" name="recado" rows="3" required></textarea>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!------------------- VIEW ------------------->
<div class="modal modal-black show fade bd-example-modal-sm" id="modalView<?php $note->issetNote($note->id);?>" tabindex="-1" role="dialog" aria-labelledby="modalView" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" ><?php echo $note->id_cond." ".$note->id;?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body">
      <div class="container">
        <h5 class="card-category">
          <div class="row">
            <div class="col-sm-6">            
            <span class=" text-primary" style=" font-weight: 700;"> 
                <?php echo $note->categoria;?> </span> &nbsp casa   
                <b  class=""style=" font-weight: 600;">
                  <?php echo $note->casa;?>
                </b>
              </div>
              <div class="col-sm-6">
              validade: <?php echo date('d/m/y' ,strtotime($note->data_exp));?>
              </div>
          </div>
        </h5>
      </div>
      <div class="container">
        <h5 class="card-category">
          <div class="row">
            <div class="col-sm-12">            
            <span class=" text-success" style=" font-weight: 700;"> 
              Recado: </span>              
                <?php echo $note->recado;?>         
            </div>
          </div>
        </h5>
      </div>
      <div class="container">
        <h5 class="card-category">
          <div class="row">
            <div class="col-sm-6">            
            <span class=" text-warning" style="font-weight: 700;"> 
              Criado por:&nbsp  </span>              
                <?php echo $note->id_user;?>         
            </div>
            <div class="col-sm-6">       
                dia:&nbsp <?php echo date('d/m/y H:i' ,strtotime($note->data_cad));?>         
            </div>
          </div>
        </h5>
      </div>
      <?php if($note->alter_user):?>
      <div class="container">
        <h5 class="card-category">
          <div class="row">
            <div class="col-sm-6">            
            <span class=" text-success" style=" font-weight: 800;"> 
              Editado por:&nbsp   </span>              
                <?php echo $note->alter_user;?>         
            </div>
            <div class="col-sm-6">       
                dia:&nbsp <?php echo date('d/m/y H:i' ,strtotime($note->alter_date));?>         
            </div>
          </div>
        </h5>
      </div>
      <?php endif; ?> 
      <?php if($note->conc_user):?>
        <div class="container">
        <h5 class="card-category">
          <div class="row">
            <div class="col-sm-6">            
            <span class=" text-danger" style=" font-weight: 800;"> 
              Concluido por:&nbsp   </span>              
                <?php echo $note->conc_user;?>         
            </div>
            <div class="col-sm-6">       
                dia:&nbsp <?php echo date('d/m/y H:i' ,strtotime($note->date_conc));?>         
            </div>
          </div>
        </h5>
      </div>
      <?php endif; ?> 
    </div>
    <div class="modal-footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">   
            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>    
    </div>
    </div>
  </div>
</div>

<!------------------- CONCLUIR ------------------->

<div class="modal modal-black show fade bd-example-modal-sm" id="modalConclude<?php echo $note->id;?>" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;">Deseja Concluir? </span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
    </div>
    <div class="modal-body">
      <form class="group-form" method="POST" action="note_process.php" onsubmit="return check_form()">
       <input type="hidden" name="type" value="concluir">        
       <input type="hidden" name="id" id="id" value="<?php echo $note->id; ?>"> 
        <span class="text-primary text-center" style=" font-weight: 940;"><?php echo $note->categoria;?></span>
        casa <span class=" text-primary" style=" font-weight: 940;"><?php echo $note->casa;?> </span> de &nbsp <span class="text-success text-center"><?php echo ucwords(strtolower($note->id_cond)); ?></span>
        <div class="form-group text-center col-md-12">
          <label for="inputAddress " ><small>Motivo:</small></label>
          <textarea class="form-control text-center text-success" id="motivo_conc" name="motivo_conc"></textarea>
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

<!------ CREATE CONDOMINO -->
<div class="modal modal-black show fade bd-example-modal-sm" id="addCondomino" tabindex="-1" role="dialog" aria-labelledby="modalConcluse" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 600;"> </span></h5>
    </div>
    <div class="modal-body">
      <form  method="POST" action="condomino_process.php" autocomplete="off" >
        <input type="hidden" name="type" value="addCondomino">
        <div class="form-row">
          <div class="col-md-10">
            <label for="exampleInputPassword1">Nome Condômino</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
            <div id="erroSenha"></div>
          </div>
          <div class="col-md-2">
            <label for="exampleInputPassword1">Casa</label>
            <input type="text" class="form-control " id="casa" name="casa"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
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