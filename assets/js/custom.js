/*const listarUsuarios = async () => {
    var inicio = document.getElementById("listar").rows.length;
    const dados = await fetch("./listar.php?inicio=" + inicio);
    const resposta = await dados.text();

    document.getElementById('conteudo').insertAdjacentHTML('beforeend', resposta);
}*/

const listarUsuarios = async () => {
  var inicio = document.getElementById("listar").rows.length;
  const events = await fetch("./listar.php?inicio=" + inicio);
  const resposta = await events.json();

  if(resposta['erro']){
      document.getElementById("msgAlerta").innerHTML = resposta['msg'];
  }else{
      document.getElementById('conteudo').insertAdjacentHTML('beforeend', resposta['events']);
  }
}

listarUsuarios();