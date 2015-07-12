<html>
    <head>
        <?php
            include "files/head.php";
        ?>
		<link href="../docs/css/select2.min.css" rel="stylesheet" />
		<script src="../docs/js/selecion2.min.js"></script>
    </head>
    <body>
        <?php 
            include "files/nav.php";
			if(isset($_GET['e'])) {
                   echo "<div class='alert alert-dismissible alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>ERROR!</strong> <a href='#' class='alert-link'>intente con un numero menor.
</div>";
                }
                
        ?>
			<div class="container-fluid">
					<div class="row">
						<div class="form-group">
							<label>Origen</label>
							<select class="js-example-basic-multiple" id="dep_city" value="dep_city" name="dep_city" style="width:250px">
							</select>
							<label>Destino</label>
							<select class="js-example-basic-multiple" id="arr_city" value="arr_city" name="arr_city" style="width:250px">
							</select>
							<label>Ida y Vuelta</label>
							<input id="ida" type="checkbox" />
							<input type="button" value="Buscar vuelos" onclick="buscarVuelos();">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="container flights">
						</div>
					</div>
					</div>
			</div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          
        </div>
    </body>
<script type="text/javascript" >
		function buscarVuelos(){
			//Validar que no se seleccionara la misma ciudad
			var depcity = $("#dep_city").val();
			var arrcity = $("#arr_city").val();
			var isOnlyDep = $("#ida").prop('checked');
			if(depcity == arrcity){
				alert("Selecciones ciudades distintas");
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