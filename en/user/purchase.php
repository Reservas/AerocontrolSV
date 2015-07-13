<html>
    <head>
        <?php
            include "files/head.php";
        ?>
         <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
     <!-- Favicon Icon -->
    <link rel="icon" href="docs/img/favicon.ico" />
    <title>Aerocontrol</title>
    <!-- BOOTSTRAP CORE CSS -->
    <link href="docs/css/bootstrap.css" rel="stylesheet" />
    <!-- ION ICONS STYLES -->
    <link href="docs/css/ionicons.css" rel="stylesheet" />
     <!-- FONT AWESOME ICONS STYLES -->
    <link href="docs/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link href="docs/css/style.css" rel="stylesheet" />
     <!-- IE10 viewport hack  -->
    <script src="docs/js/ie-10-view-port.js"></script>
   
		<link href="../docs/css/select2.min.css" rel="stylesheet" />
		<script src="../docs/js/selecion2.min.js"></script>
    </head>
    <body>
        <?php 
            include "files/menu.php";
			if(isset($_GET['e'])) {
                   echo "<div class='alert alert-dismissible alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>ERROR!</strong> <a href='#' class='alert-link'>try a smaller number.
</div>";
                }
                
        ?>
			<div class="container-fluid">
                <div class="panel panel-primary">
                     <section id="home">
        <div class="overlay">   
                    <div class="panel-heading" style="color:#fff;">
                    <h2 class="text-center">
                    Flight search</h2>
                        </div>
					<div class="row text-center">
						<div class="form-group" >
							<label style="color:#fff;" >Departure</label> <br>
							<select class="js-example-basic-multiple" id="dep_city" value="dep_city" name="dep_city" style="width:250px">
							</select> <br>
							<label style="color:#fff;"> Destination</label><br>
							<select class="js-example-basic-multiple" id="arr_city" value="arr_city" name="arr_city" style="width:250px">
							</select> <br> <br>
							<label style="color:#fff;">Round trip</label>
							<input id="ida" type="checkbox" />
							<input type="button" value="Search flights
" onclick="buscarVuelos();">
                    <div class="col-xs-12">
						<div class="container flights">
						</div>
					</div>
					
                                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          
        </div>        
						</div>
					</div>
					
            </div>
			</div>
                </div>
            </section>

    </body>
<script type="text/javascript" >
		function buscarVuelos(){
			//Validar que no se seleccionara la misma ciudad
			var depcity = $("#dep_city").val();
			var arrcity = $("#arr_city").val();
			var isOnlyDep = $("#ida").prop('checked');
			if(depcity == arrcity){
				alert("Select a different country");
			}else{
			
				$.ajax({
						type : "GET",
						dataType : 'html',
						async : true,
						data : {
							depcity : depcity,
							arrcity : arrcity,
							isOnlyDep : isOnlyDep
						},
						url : "ajax/buscar_vuelos.php",
						success : function(response) {
							$('.flights').html(response);
							$( ".comprar" ).click(function() {
								var id = $(this).attr("id");
								loadmodal(id);
							});
						},
							error : function(e, error) {
								alert(error);
						}
					});
			}
		}
		
		function loadmodal(id) {
         $.ajax({
          method: "POST",
          url: "ajax/loadmodal.php",
          data: {'id':id },
          //dataType: 'json',
          beforeSend: function() {
            
          },
          success: function(data) {
            $("#myModal").html(data);
           $('#myModal').modal('show');
          }
		});
		}
		
		$(document).ready(function()		
			{
				$.ajax({ url: "ajax/buscar_ciudad.php",
        			context: document.body,
        			success: function(data){
        				$("#dep_city").html(data);
						$("#arr_city").html(data);
        			}});
				$(".js-example-basic-multiple").select2();
			});
</script>
</html>