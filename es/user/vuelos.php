<html>
    <head>
        <?php
            include "files/head.php";
        ?>
    </head>
    <body>
        <?php 
            include "files/nav.php";
        ?>
        <div class="col-xs-12">
            <center><h1>Vuelos en tiempo real</h1></center>
            <div class="container vuelos"></div>
        </div>
    <script>
        $( document ).ready(function() {
            $(".1").addClass("active"); 
        });
    </script>
    </body>
</html>