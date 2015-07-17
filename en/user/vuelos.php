<html>
    <head>
        <?php
            include "files/head.php";
        ?>
        </head>
		<link href='../docs/calendar/fullcalendar.min.css' rel='stylesheet' />
		<link href='../docs/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
		<script src='../docs/calendar/lib/moment.min.js'></script>
		<script src='../docs/calendar/fullcalendar.min.js'></script>
		<script src='../docs/calendar/lang/en-au.js'></script>
			<link href="../docs/css/select2.min.css" rel="stylesheet" />		
    <script src="../docs/js/selecion2.min.js"></script>
		<script>

	$(document).ready(function() {
		$.ajax({ 
			url: "ajax/buscar_aerolinea.php",
			context: document.body,
			success: function(data){
				$("#airline").html(data);
			}
		});
		$(".js-example-basic-multiple").select2();
		
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
					alert("Error");
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
        <body>


        <?php 
            include "files/menu.php";
        ?> 
        <a href="vuelos.php"> <img src="../../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
        <a href="../../es/user/vuelos.php"> <img src="../../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a>
        <section id="home">
            <div class="overlay">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h1 class="text-center" style="color:#fff;">Flights in real time</h1>
            <label style="color:#fff;" >Aerolinea</label>
							<select class="js-example-basic-multiple" id="airline" value="airline" name="airline" style="width:250px" onchange="filtrarVuelos(this.value, false);">
							</select> <br>  
                          </div>

            <div class="container vuelos"></div>
        </div>
            </section>
             <section id="clients">
               <div class="overlay">
              <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Calendar</h2>
                              </div>
            
 
		<div id='calendar'></div>

    <script>		
		function filtrarVuelos(airline, unset){
			$.ajax({
				type : "POST",
				dataType : 'html',
				async : true,
				data : {
					unset: unset,
					airline : airline
				},
				url : "ajax/airline_sesion.php",
				success : function(response) {
					
				},
				error : function(e, error) {
					alert(error);
				}
			});
		}
		
        $( document ).ready(function() {
            $(".1").addClass("active");
			filtrarVuelos(0, true);
        });
    </script>
             </div>     
            </div>
                </div>
            </div>
            </section>
    </body>
</html>