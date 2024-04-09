    <footer class="footer">
        <div class="container-fluid">
          
          <div class="copyright">
            © 2022 Desenvolvido por
            <a href="https://instagram.com/brunoh_trindade" target="_blank">Bruno Trindade</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  
  <script src="lib/js/FullCalendar/main.min.js"></script>
  <script src="lib/fullcalendar.js"></script>
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
 <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

 <!-- Full Calendar -->
 <script src='lib/main.js'></script>
 <script src='lib/fullcalendar.js'></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <!-- sweet alerts 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="assets/js/core/jquery.min.js"></script>

  <script src="assets/js/core/jquery-ui.min.js"></script>

  <script src="assets/js/javascript.js"></script>
  <script>
    <?php if(isset($flashmessage['msg'])):?>
    Swal.fire({
    toast: true,
    icon: '<?= $flashmessage["type"] ?>',
    title: '<?= $flashmessage["msg"] ?>',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  <?php endif?>
  </script>


</body>

</html>
