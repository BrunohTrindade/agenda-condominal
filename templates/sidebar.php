<script>
$(document).ready(function() {
  // Verifica se há um item de estado salvo no localStorage
  var activeLink = localStorage.getItem('activeLink');

  // Se houver um link ativo salvo, adiciona a classe btn-secondary a ele
  if (activeLink) {
    $('a[href="' + activeLink + '"]').addClass('dark');
  }

  // Adiciona o evento de clique aos links
  $("a").on("click", function() {
    // Remove a classe dark de todos os links
    $("a").removeClass("dark");

    // Adiciona a classe ao link clicado
    $(this).addClass("dark");

    // Salva o estado do link ativo no localStorage
    localStorage.setItem('activeLink', $(this).attr('href'));
  });
});
</script>

<div class="sidebar">
  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="javascript:void(0)" class="simple-text logo-mini">
        <i class="tim-icons icon-chart-bar-32"></i>
      </a>
      <a href="javascript:void(0)" class="simple-text logo-normal">
        Agenda e Recados
      </a>
    </div>
    <ul class="nav active">
      <li>
        <a href="<?= $BASE_URL ?>index.php" class="dark">
          <i class="tim-icons icon-calendar-60"></i>
          <p>Agenda</p>
        </a>
      </li>
      <li>
        <a href="<?= $BASE_URL ?>eventlist.php?status=1">
          <i class="tim-icons icon-bullet-list-67"></i>
          <p>Lista de Reservas</p>
        </a>
      </li>
      <li>
        <a href="<?= $BASE_URL ?>recados.php">
          <i class="tim-icons icon-notes"></i>
          <p>Recados</p>
        </a>
      </li>
      <li>
        <a href="<?= $BASE_URL ?>regimento.php">
          <i class="tim-icons icon-components"></i>
          <p>Regimento</p>
        </a>
      </li>
    </ul>
  </div>
</div>