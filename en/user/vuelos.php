<html>
    <head>
        <?php
            include "files/head.php";
        ?>
    </head>
    <body>
        <?php 
            include "files/menu.php";
        ?>
        <div class="col-xs-12">
            <center><h1>Flights in real time</h1></center>
            <div class="container vuelos"></div>
        </div>
    <script>
        $( document ).ready(function() {
            $(".1").addClass("active"); 
        });
    </script>
    </body>
</html>