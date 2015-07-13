<?php 
include "../files/conexion.php";
        $stmt = $mysqli->prepare("SELECT flights.id,flights.departure_time,flights.cost,flights.seats,flights.description,cities.city,flights.arrival_time,flights.arrival_runway,aircraft.name,airlines.name FROM `flights` INNER JOIN cities ON flights.arrival_city=cities.id INNER JOIN aircraft ON flights.aircraft=aircraft.id INNER JOIN airlines ON flights.airline=airlines.id WHERE flights.id = ? ORDER BY `flights`.`arrival_time` ASC");
        $stmt->bind_param('s',$_POST['id']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id,$departure_time,$cost,$seats,$description,$arrival_city,$arrival_time,$arrival_runway,$aircraft,$airline);
         while ($stmt->fetch()) {
                $date = new DateTime($arrival_time);
                $now = new DateTime();
                $newFormatDep =  date("D M j y", strtotime($departure_time));
                $resta = $date->diff($now)->format("%h hours, %i minutes y %s seconds");
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
                      <form action='purchase.php' method='post'>
                      <div class='form-group ' style='margin-left:4%;margin-right:4%;'>
                          <label class='control-label'>Number of persons</label>
                          <div class='input-group'>
                            
                            <span class='input-group-addon'><i class='fa fa-users'></i></span>
                            <script>
                            function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
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
                            <input type='text' name='number' placeholder='Insert number of staff' class='form-control' onkeypress="return numeros(event)">
                          </div>
                        </div>
                      <div class='modal-footer'>
                      
                        
                        <button value='$id' name='comprar' type='submit' class='btn btn-success'>Buy flights</button>
                        </form>
                      </div>
                    </div>
                  </div>";
                        
                }
?>