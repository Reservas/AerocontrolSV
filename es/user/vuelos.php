<html>
    <head>
        <?php
            include "files/head.php";
        ?>
		<link href='../docs/calendar/fullcalendar.min.css' rel='stylesheet' />
		<link href='../docs/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
		<script src='../docs/calendar/lib/moment.min.js'></script>
		<script src='../docs/calendar/fullcalendar.min.js'></script>
		<script src='../docs/calendar/lang/es.js'></script>
		<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: 'ajax/vuelos_calendar.php',
				error: function() {
					alert("Ocurrio un error");
				}
			}//,
			//loading: function(bool) {
				//$('#loading').toggle(bool);
			//}
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>


    </head>
    <body>
        <?php 
            include "files/nav.php";
        ?>
        <div class="col-xs-12">
            <center><h1>Vuelos en tiempo real</h1></center>
            <div class="container vuelos"></div>
        </div>
		<div id='calendar'></div>

    <script>
        $( document ).ready(function() {
            $(".1").addClass("active"); 
        });
    </script>
    </body>
</html>