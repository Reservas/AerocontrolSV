<!DOCTYPE html>
<?php 
session_start();
require_once "docs/connect.php";

$user_pool = mysql_query("SELECT user FROM costumers");                          



?>
<html lang="en">
<head>
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
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- HEADER SECTION START-->
   <header id="header">
    <div class="container" >
        <div class="row"  >
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 logo-wrapper">
               <h2 style="margin:0px;"><i class="fa fa-plane"></i>AeroControl</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right" >
                <div class="menu-links scroll-me">
                    <a href="#header"> <i class="ion-ios-home-outline"></i> </a>
                    <a href="#about"> <i class="ion-ios-camera-outline"></i> </a>
                    <a href="#clients"> <i class="ion-ios-grid-view-outline"></i> </a>
                    <a href="#contact"> <i class="ion-ios-chatboxes-outline"></i> </a>
                </div>                    
            </div>
        </div>
    </div>
   </header>
    <!-- HEADER SECTION END-->
    <!--HOME SECTION START  -->
    <div id="home">
        <div class="overlay">
            <div class="container">
                <div class="row scroll-me">
                    
                </div>
            </div>
        </div>

    </div>
    <!--HOME SECTION END  -->
     <!-- ABOUT SECTION START-->

<!--     <script type="text/javascript"> 
     function alpha(e) {
       var k;
       document.all ? k = e.keyCode : k = e.which;
       return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k==32);
    }

    function numbers(e) {
       var k;
       document.all ? k = e.keyCode : k = e.which;
       return ((k > 47 && k < 58) || k==45 k == 8 || k==32);
    }
     </script> -->
    
    <section id="about" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Costumers</h2>
                          </div>
                          <div class="panel-body">
                            <form action="validate.php" method="post">
                              <label>Username</label>
                              <input type="text"  class="form-control input-sm" id="user" name="user" placeholder="Username" autocomplete="off" required  > 
                              <label>Password</label>
                              <input type="password"  class="form-control input-sm" name="pass" placeholder="¨Password" autocomplete="off" required>
                              <?php
                                if(isset($_SESSION['error'])) 
                                {
                                    $error = $_SESSION['error'];
                                    if ($error == 1) 
                                    {
                                        echo '
                                            <div class="alert alert-dismissible alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                User or pass incorrect
                                            </div>
                                        ';
                                        session_destroy();
                                    }
                                }
                              ?>
                                <script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
</script>
                          </div> 
                          <div class="panel-footer">
                              <input type="submit" class="btn btn-success btn-xs" value="Iniciar" style="width:100%;">
                            </form>
                          </div>
                        </div>
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Airlines</h2>
                          </div>
                            <div class="panel-body">
                                <select class="form-control input-sm" id="airlines">
                                  <?php
                                    $query = mysql_query("SELECT name, id FROM airlines");
                                    while($row = mysql_fetch_row($query))
                                    {
                                        echo "<option value='".$row[1]."'>".$row[0]."</option>";
                                    }
                                  ?>
                                </select>
                            </div>
                          <div class="panel-footer">
                              <a><input type="button" id="airlbtn" class="btn btn-success btn-xs" value="ILogin" style="width:100%;"></a>
                          </div>
                        </div>
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Admin</h2>
                          </div>
                          <div class="panel-footer">
                              <a href="adminlog.php"><input type="button" id="airlbtn" class="btn btn-success btn-xs" value="Admin" style="width:100%;"></a>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h2 class="text-center" style="color:#fff;">Costumer Log in</h2>
                          </div>
                          <div class="panel-body">
                            <form name="register" action="register.php" method="post">
                              <div class="col-md-6"> 
                                <label>Username</label>
                                <input type="text" class="form-control input-sm" name="user" placeholder="Username" autocomplete="off" required > 
                                <label>Password</label>
                                <input type="password" class="form-control input-sm" name="pass" placeholder="Password" autocomplete="off" required pattern=".{6,12}"   required title="6 caractères como mìnimo ">  
                                <label>Repit password</label>
                                <input type="password" class="form-control input-sm" name="rpass" placeholder="Repit password" autocomplete="off" required pattern=".{6,12}"   required title="6 caractères como mìnimo"   >
                                <label>Birthday</label>
                                  <script>
                                  function compruebaFecha($date){
if ($date == "" || $date == "aaa/mm/dd")
return false;
if (!ereg("^([[:digit:]]{4})/([[:digit:]]{2})/([[:digit:]]{2})$", $date, $vec))
return false;
else{
if ($vec[1] <= 31)
return false;
if ($vec[2] <= 12)
return false;
if ($vec[3] <= date("Y") + 1)
return false;
if ($date != date("Y/m/d",mktime(0,0,0, $vec[3], $vec[1], $vec[2])))
return false;
}
return true;
}
                        function normalize_date($date){   
                            
                            if(!empty($date)){ 
                                $var = explode('/',str_replace('-','/',$date)); 
                                return "$var[2]/$var[1]/$var[0]"; 
                            
                            }   
                        
                        } 
                                  </script>
                                <input type="date"  class="form-control input-sm" name="nac" placeholder="Birthday" autocomplete="off" required  max=”1996-12-31″. > 
                                <label>Cellphone</label>
                                  
                                <input type="text" class="form-control input-sm" name="phone" maxlength="8" placeholder="7*******" autocomplete="off" required
                                onKeyPress="return soloNumeros(event)"required="" pattern="7[0-9]{7}"> 
                              </div>
                              <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control input-sm" name="name" placeholder="NAme" autocomplete="off" required
                                onkeypress="return alpha(event)" > 
                                <label>Country</label>
                                <!--<div class="panel-body">-->
                                  <select class="form-control input-sm" id="city" name="city">
                                    <option value="">Chosse a country</option>
                                    <?php
                                      $query = mysql_query("SELECT state FROM cities");
                                      while($row = mysql_fetch_row($query))
                                      {
                                          echo "<option value='".$row[0]."'>".$row[0]."</option>";
                                      }
                                    ?>
                                  </select>
                                <!--</div>-->
                                <!--<input type="text" class="form-control input-sm" name="city" placeholder="Pais" autocomplete="off" required 
                                onkeyup="this.value=this.value.replace(/[^a-zA-Z] /g,'');"> -->
                                <label>Estate</label>
                                <input type="text" class="form-control input-sm" name="state" placeholder="Estate" autocomplete="off" required 
                                onkeypress="return alpha(event)"> 
                                <label>Address</label>
                                <input type="text" class="form-control input-sm" name="address" placeholder="Address" autocomplete="off" required> 
                                <label>E-mail</label>
                                <input type="text" class="form-control input-sm" name="mail" placeholder="E-mail" autocomplete="off" required> 
                              </div>
                          </div> 
                          <div class="panel-footer">
                              <input type="submit" class="btn btn-success form-control btn-sm" value="Register">
                            </form>
                          </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- ABOUT SECTION END-->
        
     <!-- CLIENTS SECTION START-->
    <section id="clients">
        <div class="overlay">       
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        
                </div>
            </div>
           
        </div>
             </div>
    </section>
     <!-- CLIENTS SECTION END-->
    <!-- FEATURES SECTION START-->
    <section id="features">
        <div class="container">
            
            <div class="col-xs-12">
            <center><h1>Flights in real time</h1></center>
            <div class="container vuelos"></div>
        </div>
</div>

    </section>
    <!-- FEATURES SECTION END-->  
    
     <!-- CONTACT SECTION START-->
    <section id="contact">
        <div class="overlay">       
        <div class="container">
            <div class="row text-center">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  contact-cover" >
                     <h2>Colegio Santa Cecilia</h2>
                     <h3>Calle Don Bosco y Av. Manuel Gallardo</h3>
                     <h3>Santa Tecla, El Salvador.</h3>
                     <div class="space"> </div>
                      <div class="social">
                        <a href="https://www.facebook.com/AerocontrolSV"><i class="fa fa-facebook "></i></a>
                        <a href="https://www.Twitter.com/AerocontrolSV"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
               
               
            </div>
           
        </div>
             </div>
    </section>
     <!-- CONATCT SECTION END-->
    <!-- FOOTER SECTION START-->
    
<!--
    <footer>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                &copy; 2015 YourDomain.com | by <a href="http://www.designbootstrap.com/" target="_blank"> DesignBootstrap </a> 
            </div>
        </div>
    </div>
    </footer>
-->
    <!-- FOOTER SECTION END-->

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  SCRIPTS -->
    <script src="docs/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="docs/js/bootstrap.js"></script>
    <!-- SCROLLING SCRIPTS PLUGIN  -->
    <script src="docs/js/jquery.easing.min.js"></script>
    <!-- CUSTOM SCRIPTS   -->
    <script src="docs/js/custom.js"></script>
    <script>
        $( document ).ready(function() {
            $( "#airlbtn" ).click(function() {
                var clickselect = $("#airlines").val();
                window.location.href = "loginairl.php?airline=" + clickselect;
            });   
    function loadVuelos() {
    $.ajax({
          method: "POST",
          url: "user/ajax/algorit.php",
          data: { },
          //dataType: 'json',
          beforeSend: function() {
            
          },
          success: function(data) {
            $(".vuelos").html(data);
          }
      });
    }
    loadVuelos();
     window.setInterval(function(){
        loadVuelos();
    }, 1000);
});
    </script>
</body>
</html>
