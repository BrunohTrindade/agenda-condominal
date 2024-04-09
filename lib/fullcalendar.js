

 document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left:'prevYear,nextYear',
      center: 'title'
    },
    buttonText:{
      today:    'hoje',
      prevYear:'<<',
      prev:'<',
      next:'>',
      nextYear: '>>'
  },
    selectable: true,
    selectMirror: true,
    themeSystem: 'bootstrap5',
    navLinks: true, 
     locale:'pt-br',
    dateClick: function(info) {
      window.location.href='?date='+info.dateStr;        
    },
    initialDate: '2021-10-15',
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    events: 'evenList.php',
    eventClick: function(info) {
        window.location.href=`?id=${info.event.id}`
  }
    
  });

  calendar.render();
});