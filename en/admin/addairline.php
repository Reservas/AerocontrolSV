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
    <title>Administración - Add airline</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Add airline</h1>
<?php
if(isset($_POST["name"]) AND isset($_POST["description"]))
{
    $name = $_POST["name"];
    $description = $_POST["description"];
    // subida de imagen
    $mensaje='';
    # MIME types permitidos
    $mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
    # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
    if( !in_array( $_FILES['imagen']['type'], $mime ) )
    {
        $error = true;
        $mensaje = "<p class='text-danger text-center'>Only JPG, PNG, GIF images type are allowed.</p>";
    }
    # Le decimos al usuario que se olvido de subir un archivo
    if( $_FILES['imagen']['type'] == '' )
    {
        $error = true;
        $mensaje .= "<p class='text-danger text-center'>No image is received</p>";
    }
    # Indicamos hasta que peso de archivo puede subir el usuario.
    if( $_FILES['imagen']['size'] > 1048576 )
    {
        $error = true;
        $mensaje .= "<p class='text-danger text-center'>The image must weigh less than 1 MB</p>";
    }
    # Si el archivo cumple con las expectativas quiere decir que la variable $error viene vacia y se ejecutará la función que colocaremos ahí
    if(empty($error))
    {
        # Aquí es donde estará nuestro array();
                
		$target_path = "../airline/docs/img/logo/";

		/* Add the original filename to our target path.  
		Result is "uploads/filename.extension" */
		//$titulo = $name;
		$trozos = explode(".", $_FILES['imagen']['name']); 
        $imgnameo = $_FILES['imagen']['name'];
		$extension = end($trozos);  
		$target_path = $target_path . $name . '.' . $extension; 
		$base = $name . '.' . $extension; 

		include "../docs/connect.php";
		$sql = mysql_query("INSERT INTO airlines (id, name, description, logo) VALUES ('', '$name','$description','$base')");
                $contador = mysql_query($sql);
		
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) 
		{
            echo "<p class='text-success text-center'><strong>Data were stored</strong></p>";
            echo "<p class='text-success text-center'><strong>The image &quot;".  basename( $_FILES['imagen']['name']). 
		"&quot;  is properly up to the system</strong></p>";
            echo "<hr><p class='text-warning text-center'><strong><a href='addairlineadmin.php?air=".mysql_insert_id()."'>Add administrator to this airline</a></strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>List of airlines</a></p>";
		} 
		else
		{
            echo "<p class='text-danger text-center'><strong>Error: the data were not saved</strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>List of airlines</a></p>";
		}
    }
    else
    {
    	echo $mensaje;
    }
}
?>
        <div class="col-md-4 well">
            <h3>Help</h3>
            <p>Write the <strong>name</strong>of the airline what you want to register, later a little <strong>description</strong> now and for the <strong>logo </strong>of the airline.</p>
        </div>
        <div class="col-md-8">
        <form enctype="multipart/form-data" method="post" action="addairline.php">
            <div class="form-group">
            <label for="name">Name of the airline</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name of the airline" required>
            </div>
            <div class="form-group">
            <label for="description">Description (Max 300 characters)</label>
            <textarea class="form-control" id="description" name="description" rows="3" maxlength="300"></textarea>
            </div>
            <div class="form-group">
            <label for="imagen">Image</label>
            <input name="imagen" type="file" required/>
            </div>
            <input type="submit" name="enviar" value="Save">
        </form>
        </div>
    </div>    
</div>
</body>
</html>