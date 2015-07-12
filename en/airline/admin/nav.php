  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Aerocontrol</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?=$row['name']?></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">User</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../cerrar_sesion.php"
               >Log out</a></li>
      </ul>
    </div>
  </div>
    </nav>