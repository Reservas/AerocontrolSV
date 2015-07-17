<script>
function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}
</script>  
<?php 
include "../files/conexion.php";
        $stmt = $mysqli->prepare("SELECT bookings.id as bookid,flights.id,bookings.seats,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `bookings` INNER JOIN flights ON bookings.flight=flights.id INNER JOIN costumers ON costumers.id=bookings.costumer INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE bookings.id = ? ORDER BY `flights`.`arrival_time` ASC");
        $stmt->bind_param('i',$_GET['bookid']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($bookid,$id,$seat,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
         while ($stmt->fetch()) {
                $date = new DateTime($arrival_time);
                $now = new DateTime();
                $newFormatDep =  date("D M j y", strtotime($departure_time));
                $resta = $date->diff($now)->format("%h horas, %i minutos y %s segundos");
                $restaDos = $date->diff($now)->format("%h");
                        
                echo "<div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>$arrival_city</h4>
                      </div>
                      <div class='modal-body'>
                        <p>$description</p>
                          <div style='margin-bottom:3%;'>
                            <a class='btn btn-info'><i class='fa fa-plane'></i> $airline</a>
                            <a class='btn btn-info'><i class='fa fa-clock-o'></i> $newFormatDep</a>
                             <a class='btn btn-info'><i class='fa fa-users'></i> $seats</a>
                            <a class='btn btn-success'><i class='fa fa-usd'></i> $cost</a>
                          </div>  
                      </div>
                      <form action='ajax/cancelar_vuelo.php' method='post'>
                      <div class='form-group ' style='margin-left:4%;margin-right:4%;'>
                          <label class='control-label'>Justificacion</label>
						  <textarea  name='justification' maxlength='512' placeholder='Ingrese la justificacion' class='form-control' required='required' />
						  <input type='hidden' name='bookid' value='$bookid' />
                        </div>
                      <div class='modal-footer'>
                        
                        <button  name='cancelar' type='submit' class='btn btn-danger'>Cancelar Vuelo</button>
                        </form>
                      </div>
                    </div>
                  </div>";
                        
                }
?>