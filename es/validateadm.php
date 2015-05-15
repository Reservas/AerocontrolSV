<?php
session_start();
require "docs/connect.php";
$noexist = false;
if(isset($_POST['user'],$_POST['pass']))
{
    try
    {
        $db = new PDO("mysql:host=". $hostname . ";dbname=$database", $username, $password);
        $stmt = $db->prepare("SELECT * 
                                FROM  `admin` 
                                WHERE  `user` =   :user 
                                AND  `password` =   :pass 
                                LIMIT 0 , 30");
        $stmt->bindParam(':user',$_POST['user'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', md5($_POST['pass']), PDO::PARAM_STR);
        $stmt->execute();
        $noexist = true;
            if($result = $stmt->fetchAll()) {
                foreach($result as $row){
                    header("location:admin/");
                    $_SESSION['usuario'] = $row['Usuario'];
                    $_SESSION['airline'] = $row['airline'];
                    $_SESSION['tipo'] = $row['air-admin'];
                }
            }else{
	           header("location: ./loginairl.php?airline=".$_POST['airline']);
	           exit();
            }
        
        $db = null; 
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>
