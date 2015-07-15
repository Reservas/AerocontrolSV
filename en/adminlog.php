    <!DOCTYPE html>
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
          
        <link href="docs/css/style.css" rel="stylesheet"/>
         <!-- IE10 viewport hack  -->
        <script src="docs/js/ie-10-view-port.js"></script>
        <style>
            body{
                background-image: url('docs/img/login-wallpaper.jpg');
                background-attachment: fixed;
                background-position: center center;
                background-size: 100%;
            }  
        </style>

        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

      <body>

        <div class="container">    
          <!--login modal-->
            <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
            <a href="adminlog.php"> <img src="../base_de_datos/Ingles.jpg" class="redondo" width=60 height=30/></a>
            <a href="../es/adminlog.php"> <img src="../base_de_datos/descarga" class="redondo"  width="60" height="30"/> </a> 
            
                      <h1 class="text-center">Administrator</h1>
                      <hr style="width:50%;">
                      <h4 class="text-center">Login</h4>
                  </div>
                  <div class="modal-body">
                      <form action="validateadm.php" method="post">
                        <div class="form-group">
                            <label>User</label>
                          <input type="text" class="form-control input-sm" name="user" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                          <input type="password" class="form-control input-sm" name="pass" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                        
                          <input class="btn btn-primary btn-sm btn-block" value="Login!" type="submit">
                          <!--<span><a href="#">Need help?</a></span>-->
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <div class="col-md-12">
                      <a href="./"><button class="btn">Cancel</button></a>
                      </div>	
                  </div>
              </div>
              </div>
            </div>

        </div> <!-- /container -->


        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  SCRIPTS -->
        <script src="docs/js/jquery-1.11.1.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="docs/js/bootstrap.js"></script>
        <!-- SCROLLING SCRIPTS PLUGIN  -->
        <script src="docs/js/jquery.easing.min.js"></script>
        <!-- CUSTOM SCRIPTS   -->
        <script src="docs/js/custom.js"></script>
      </body>
    </html>
