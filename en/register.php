<?php
    require_once 'connect.php';
    if(isset($_POST['user'],$_POST['pass'],$_POST['rpass'],$_POST['nac'],$_POST['phone'],$_POST['name'],$_POST['city'],$_POST['state'],$_POST['address'],$_POST['mail'])) 
    {
        if(!empty($_POST['user']) and !empty($_POST['pass']) and !empty($_POST['rpass']) and !empty($_POST['nac']) and !empty($_POST['phone']) and !empty($_POST['name']) and !empty($_POST['city']) and !empty($_POST['state']) and !empty($_POST['address']) and !empty($_POST['mail'])) 
        {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $md5 = md5($_POST['pass']);
            $rpass = $_POST['rpass'];
            $nac = $_POST['nac'];
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $address = $_POST['address'];
            $email = $_POST['mail'];
            $checkuser=mysql_query("SELECT * FROM costumers WHERE user='$user'",$link);
            $check_user=mysql_num_rows($checkuser);
                if($pass==$rpass){
                    if($check_user>0){
                        echo '<script language="javascript">alert("Warning, these username already exist")</script>';
                        echo"<script>location.href='index.php'</script>";
                    }else{
                        require 'docs/phpmailer/PHPMailerAutoload.php';
                        $mail = new PHPMailer(true);
                        $mail -> charSet = "UTF-8";
                        $mail->IsSMTP();            
                        $mail->SMTPAuth   = true;                  
                        $mail->Host       = "mail.aerocontrolsv.com"; 
                        $mail->Port       = 26;                   
                        $mail->Username   = "admin@aerocontrolsv.com"; 
                        $mail->Password   = "G.QwkvJ4]Axs";        
                        $mail->AddAddress($_POST['mail'],$name);
                        $mail->SetFrom('admin@aerocontrolsv.com', 'Aerocontrol');
                        $mail->Subject = "Activacion de cuenta";
                        $mensaje="<a href='http://aerocontrolsv.com/activar.php?user=".$user."'>Click here to activate your account</a>";
                        $mail->msgHTML($mensaje);
                        $mail->Send();
                        try
                        {
                            $db = new PDO("mysql:host=". $hostname . ";dbname=". $database, $username, $password);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $db->prepare("INSERT INTO costumers VALUES('', :name, :address, :city, :state, :mail, :birthdate, :phone, :user, :password, '0')");
                            $stmt->bindParam(':name',$name, PDO::PARAM_STR);
                            $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                            $stmt->bindParam(':city',$city, PDO::PARAM_STR);
                            $stmt->bindParam(':state',$state, PDO::PARAM_STR);
                            $stmt->bindParam(':mail',$email, PDO::PARAM_STR);
                            $stmt->bindParam(':birthdate',$nac, PDO::PARAM_STR);
                            $stmt->bindParam(':phone',$phone, PDO::PARAM_STR);
                            $stmt->bindParam(':user',$user, PDO::PARAM_STR);
                            $stmt->bindParam(':password',$md5, PDO::PARAM_STR);
                            $stmt->execute();
                            echo "<script>alert('The user registered successfully')</script>";
                            echo"<script>location.href='index.php'</script>";
                        }catch(PDOException $e){
                            echo $e->getMessage();
                        }
                    }
                }else{
                    echo '<script language="javascript">alert("The passwords are incorrect")</script>';
                    echo"<script>location.href='index.php'</script>";
                }
        }
        else
        {

        }
    }
    else
    {
    
    }
?>