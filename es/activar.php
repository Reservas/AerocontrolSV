<?php
require 'connect.php'; 
    if (isset($_GET['user']))
    {
        $user = $_GET['user'];
        $checkuser=mysql_query("SELECT * FROM costumers WHERE user='$user'",$link);
        $check_user=mysql_num_rows($checkuser);
            if($check_user>0){
                mysql_query("UPDATE costumers SET status = '1' WHERE user='$user'",$link);
                header("location: ./index.php");
            }
            else
            {
                header("location: ./index.php");
            }
    }
    else
    {
        header("location: ./index.php");
    }

?>