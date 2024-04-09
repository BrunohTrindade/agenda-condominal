$(function () {
  $("#id_cond").autocomplete({
      source: 'proc_pesq_msg.php'
  });
});
$(function () {
  $("#id_cond1").autocomplete({
      source: 'proc_pesq_msg.php'
  });
});

function buscarNome(nome) {
  $.ajax({
    url: "moradores_pesq.php",
    method: "POST",
    data: {nome:nome},
    success: function(data){
      $('#resultado').html(data);
    }
  });
}


  $('#buscar').keyup(function(){
    var nome = $(this).val();
    if (nome != ''){
      buscarNome(nome);
    }
  });


  function check_form() {
    var inputs = document.getElementsByClassName('required');
    var len = inputs.length;
    var valid = true;
  
    for (var i = 0; i < len; i++) {
      if (!inputs[i].value) {
        valid = false;
        break; // Saia do loop assim que encontrar um campo vazio
      }
    }
  
    if (!valid) {
      Swal.fire({
        toast: true,
        icon: 'warning',
        title: 'Error',
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
      });
    }
    return valid;
  }
  

function check_formNote(){
  var inputs = document.getElementsByClassName('required');
  var len = inputs.length;
  var valid = true;
  for(var i=0; i < len; i++){
     if (!inputs[i].value){ valid = false; }
  }
  if (!valid){
    alert('Por favor preencha todos os campos.');
    return false;
  } else { return true; }
}

function validarSenha(){
  var senha = document.getElementById("password").value;  

  if(senha == "" || senha.length < 5) {
      document.getElementById("erroSenha").innerHTML = '<div class="text-danger">Senha deve conter 5 digitos no minimo!</div>';
  }else{
      document.getElementById("erroSenha").innerHTML = `<div class="text-success">Senha valida!!!</div>`;
  }
}

function validarSenhas(){
  var senha = document.getElementById("password").value;
  var confirm_senha = document.getElementById("confirm_password").value;
  
  if(confirm_senha == senha){
    document.getElementById("confirm_pass").innerHTML = `<div class="text-success"> As senhas estão iguais!</div>`;
  }else{
    document.getElementById("confirm_pass").innerHTML = `<div class="text-danger"> As senhas devem ser preenchidas igualmente!</div>`;
  }
}

