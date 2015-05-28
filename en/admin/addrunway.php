<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="../docs/css/bootstrap.css" rel="stylesheet">
    <link href="../docs/css/font-awesome.css" rel="stylesheet">
    <link href="../docs/css/ionicons.css" rel="stylesheet">
    <script src="../docs/js/bootstrap.js" type="text/javascript"></script>
    <script src="../docs/js/ie-10-view-port.js" type="text/javascript"></script>
    <script src="../docs/js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="../docs/js/jquery.easing.min.js" type="text/javascript"></script>
    <title>Administrator - Add runways</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Add runways</h1>
<?php
if(isset($_POST["idairport"]) AND isset($_POST["lenght"]))
{
    $idairport = $_POST["idairport"];
	$lenght = $_POST["lenght"];
    include "../docs/connect.php";
    $query = mysql_query("INSERT INTO runways (id, idairport, length) VALUES ('','$idairport','$lenght')");
    if($query)
    {
        echo "<p class='text-success text-center'><strong>The data were saved</strong></p>";
        echo "<p class='text-success text-center'><a href='runways.php'>List of runways</a></p>";
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: The data were not saved</strong></p>";
        echo "<p class='text-success text-center'><a href='runways.php'>List of runways</a></p>";
    }
}
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>You need put the name of the <strong>runways</strong> </p>
        </div>
        <div class="col-md-8">
        <form method="post" action="addrunway.php">
		<div class="form-group">
            <label for="idairport">Airport</label>
            <select class="form-control" name="idairport" id="idairport" required>
                <option value="">Choose the airport</option>
                <?php
                include "../docs/connect.php";
                $query = "SELECT id, name FROM airports ORDER BY id";
                $resultado = mysql_query($query, $link);
                $total = mysql_num_rows($resultado);
                if($total>0)
                {
                    while($row = mysql_fetch_array($resultado))
                    {
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }                    
                }
                ?>
            </select>
			</div>
			<div class="form-group">
				<label for="lenght">Lenght</label>
				<input type="number"  min="1" step="1" class="form-control" id="lenght" name="lenght" placeholder="Lenght" required>
            </div>
            <input type="submit" name="enviar" value="Send">
        </form>
        </div>
    </div>    
</div>
</body>
</html>