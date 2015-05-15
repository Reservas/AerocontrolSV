$( document ).ready(function() {
    
    function loadReserva() {
    $.ajax({
          method: "POST",
          url: "ajax/reserva.php",
          data: { },
          //dataType: 'json',
          beforeSend: function() {
            
          },
          success: function(data) {
            $(".reservas").html(data);
               $( ".comprar" ).click(function() {
                var id = $(this).attr("id");
                loadmodal(id);
            });
          }
      });
    }
    function loadVuelos() {
    $.ajax({
          method: "POST",
          url: "ajax/algorit.php",
          data: { },
          //dataType: 'json',
          beforeSend: function() {
            
          },
          success: function(data) {
            $(".vuelos").html(data);
           
          }
      });
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
    loadReserva();
    loadVuelos();
     window.setInterval(function(){
        loadVuelos();
    }, 1000);
    
});