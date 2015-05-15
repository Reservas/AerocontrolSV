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
    <title>Administración - Editar aerolinea</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <!-- NAV -->
    <?php include 'nav.php'; ?>
    <!-- /NAV -->
        <h1 class="text-center">Editando datos de un aerolinea</h1>
<?php
if(isset($_POST["idair"]) AND isset($_POST["name"]) AND isset($_POST["description"]))
{
    $idair = $_POST["idair"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    // subida de imagen
    $mensaje='';
    # MIME types permitidos
    if (isset($_FILES["imagen"]))
    {
    $mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
    # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
    if( !in_array( $_FILES['imagen']['type'], $mime ) )
    {
        $error = true;
        $mensaje = "<p class='text-danger text-center'>Solo es permitido subir imagenes tipo JPG, PNG y GIF</p>";
    }
    # Le decimos al usuario que se olvido de subir un archivo
    if( $_FILES['imagen']['type'] == '' )
    {
        $error = true;
        $mensaje .= "<p class='text-danger text-center'>No se recibió ninguna imagen</p>";
    }
    # Indicamos hasta que peso de archivo puede subir el usuario.
    if( $_FILES['imagen']['size'] > 1048576 )
    {
        $error = true;
        $mensaje .= "<p class='text-danger text-center'>La imagen debe pesar menos de 1 MB</p>";
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
		$sql = mysql_query("UPDATE airlines SET name='$name', description='$description', logo='$base' WHERE id=$idair");
                $contador = mysql_query($sql);
		
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) 
		{
            echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><strong>La imagen &quot;".  basename( $_FILES['imagen']['name']). 
		"&quot; se subio exitosamente al sistema</strong></p>";
            echo "<hr><p class='text-warning text-center'><strong><a href='addairlineadmin.php?air=".mysql_insert_id()."'>Agregar un administrador a esta aerolinea</a></strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>Lista de aerolineas</a></p>";
		} 
		else
		{
            echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>Lista de aerolineas</a></p>";
		}
    }
    else
    {
    	echo $mensaje;
    }
    }
    else
    {
        include "../docs/connect.php";
		$sql = mysql_query("UPDATE airlines SET name='$name', description='$description' WHERE id=$idair");
        if($sql)
        {
            echo "<p class='text-success text-center'><strong>Los datos fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>Lista de aerolineas</a></p>";
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: los datos no fueron guardados</strong></p>";
            echo "<p class='text-success text-center'><a href='airlines.php'>Lista de aerolineas</a></p>";
        }
    }
}
else
{
    if(isset($_GET["air"]))
    {
        include "../docs/connect.php";
        $idr = $_GET["air"];
        $query = "SELECT * FROM airlines WHERE id = '$idr' ORDER BY id";
        $resultado = mysql_query($query, $link);
        $total = mysql_num_rows($resultado);
        if($total == 1)
        {
            while($row = mysql_fetch_array($resultado))
            {
?>
        <div class="col-md-4 well">
            <h3>Ayuda</h3>
            <p>Aquí se podrá editar todo, referente a la aerolínea escogida</p>
            <p>A sdglbsfg fgr rgiuf <strong>texto negrita</strong> uwehiw  goegpe fgubgr gwurgif sdqjerpqn asflbdfkjbsdkgj sglbd flsdf sdfbjsdkfb sdkfb</p>
        </div>
        <div class="col-md-8">
        <form enctype="multipart/form-data" method="post" action="editairline.php">
            <div class="form-group">
            <label for="idair">Nombre de la aerolinea</label>
            <input type="text" class="form-control" id="idair" name="idair" value="<?=$row["id"]?>" readonly>
            </div>
            <div class="form-group">
            <label for="name">Nombre de la aerolinea</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$row["name"]?>" >
            </div>
            <div class="form-group">
            <label for="description">Descripción (Maximo 300 caracteres)</label>
            <textarea class="form-control" id="description" name="description" rows="3" maxlength="300"><?=$row["description"]?>     </textarea>
            </div>
            <div class="form-group">
            <label for="imagen">Subir imagen de logo</label>
            <input name="imagen" type="file"/>
            </div>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        </div>        
<?php
            }
        }
        else
        {
            echo "<p class='text-danger text-center'><strong>Error: el aerolinea no existe. <a href='airlines.php'>Lista de aerolineas</a></strong></p>"; 
        }
    }
    else
    {
        echo "<p class='text-danger text-center'><strong>Error: no hay id de aerolinea. <a href='airlines.php'>Lista de aerolineas</a></strong></p>"; 
    }
}
?>
    </div>    
</div>
</body>
</html>