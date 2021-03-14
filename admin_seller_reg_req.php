<!DOCTYPE html>
<html>
    <head>
        <title>Seller Registration Request</title>
    </head>
    <body>
        <?php            

            $search_result=$profile="";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Search") {
                $log_file = fopen("del_reg.txt", "r");                    
                    $data = fread($log_file, filesize("del_reg.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);

                        if($_POST['target']==$json_decode['email']){
                        
                        $search_result=  $json_decode['firstname']."-->".$json_decode['email']."-->".$json_decode['phone'];
                        $profile="Profile";
                        session_start();
                        $_SESSION['del_id'] = $json_decode['email'];
                        }
                    }
                    if($search_result == ""){
                        $search_result= "No data found!!!";
                    }
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Profile") {
                header('Location: admin_deliveryman_profile.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Dashboard") {
                unset($_SESSION['del_id']);
                header('Location: admin_dashboard.php');
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Change Password") {
                unset($_SESSION['del_id']);
                header('Location: admin_change_pass.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['del_id']);
                unset($_SESSION['user']);
                header('Location: login.php');
            }
        ?>
        
        <h1 >Requested Registration form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <div style = "text-align:right;">


            <input type="submit" value="Change Password" name="button">
            
            <input type="submit" value="Logout" name="button"> 

        </div>

            

                <label for="username">Search by Email:</label>
                <input type="text" name="target" id="target">
                <input type="submit" value="Search" name="button"> 

                <br>

                <?php echo $search_result; ?>
                <input type="submit" value="<?php echo $profile; ?>" name="button">


                <fieldset>
                <legend><b>Unverified List:</b></legend>

                <?php
                    $log_file = fopen("Login.txt", "r");                    
                    $data = fread($log_file, filesize("Login.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                   
                    echo "Serial-->Email"."<br>";

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['status']=="requested" && $json_decode['type']=="seller"){
                            echo ($i+1)."-->".$json_decode['username']."<br>";
                        }
                    }
                ?>


                
                </fieldset>

        <div style = "text-align:center;">


        <input type="submit" value="Dashboard" name="button">

        </div>

        </form>
        
    </body>
</html>