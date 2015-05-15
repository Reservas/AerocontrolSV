<?php
session_start();
require_once "connect.php";
$noexist = false;
if(isset($_POST['user']))
{
    try
    {
        $md5 = md5($_POST['pass']);
        $db = new PDO("mysql:host=". $hostname . ";dbname=$database", $username, $password);
        $stmt = $db->prepare("SELECT * FROM `costumers` WHERE `user`  = :usuario AND `password` = :pass");
        $stmt->bindParam(':usuario',$_POST['user'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $md5, PDO::PARAM_STR);
        $stmt->execute();
        $noexist = true;
            if($result = $stmt->fetchAll()) {
                foreach($result as $row){
                    switch($row['status'] ){
                        case 1:
                        header("location:./user/vuelos.php");
                        $_SESSION['usuario'] = $row['Usuario'];
                         $_SESSION['id'] = $row['id'];
                        exit();

                        case 0:
                        header("location: ./index.php");
                        $_SESSION['error'] = 1;
                        exit();
                    }
                }
            }else{
	           header("location: ./index.php");
               $_SESSION['error'] = 1;
	           exit();
            }
        
        $db = null; 
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>
