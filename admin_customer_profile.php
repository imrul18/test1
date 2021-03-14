<!DOCTYPE html>
<html>
    <head>
        <title>Seller List</title>
    </head>
    <body>
        <?php     
        
        session_start();
        $userid = $_SESSION['customer_id'];

        $log_file = fopen("customer_reg.txt", "r");        
        $data = fread($log_file, filesize("customer_reg.txt"));
        fclose($log_file);

        $data_filter = explode("\n", $data);
        
        for($i = 0; $i< count($data_filter)-1; $i++) {
            
            $json_decode = json_decode($data_filter[$i], true);

            if($json_decode['email'] == $userid) 
            {
                $firstname = $json_decode['firstname'];
                $lastname = $json_decode['lastname'];
                $gender = $json_decode['gender'];
                 $phone = $json_decode['phone'];
                $location = $json_decode['location'];
                $email = $json_decode['email'];
                $image = $json_decode['image'];
            }
        }
        


            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Dashboard") {
                unset($_SESSION['customer_id']);
                header('Location: admin_dashboard.php');
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Change Password") {
                unset($_SESSION['customer_id']);
                header('Location: admin_change_pass.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['customer_id']);
                unset($_SESSION['user']);
                header('Location: login.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Remove Account") {
                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    $log_filepath = "Temp.txt";

                    $log_file = fopen($log_filepath, "a");

                    for($i = 0; $i< count($data_filter)-1; $i++) {
                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $userid){
                            $usertable = array('username' => $json_decode['username'], 'password' => $json_decode['password'], 'type' => $json_decode['type'], 'status' => 'deactive');
                            $usertable_encoded = json_encode($usertable);
                            fwrite($log_file, $usertable_encoded . "\n");                            	
                        } 
                        else{
                            $usertable_encoded = json_encode($json_decode);
                            fwrite($log_file, $usertable_encoded . "\n");
                        }
                    }
                    fclose($log_file);

                    $log_file = fopen("Temp.txt", "r");                    
                    $data = fread($log_file, filesize("Temp.txt"));                    
                    fclose($log_file);

                    $log_file = fopen("Login.txt", "w");
                    fwrite($log_file, $data);                    
                    fclose($log_file);

                    
                unset($_SESSION['seller_id']);
                header('Location: admin_dashboard.php');
            }
        ?>
        
        <h1 >Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <div style = "text-align:right;">


            <input type="submit" value="Change Password" name="button">
            
            <input type="submit" value="Logout" name="button"> 

        </div>

                <fieldset>
                <legend><b>Profile:</b></legend>

                <?php echo '<img src="image/'.$image.'" alt="Image" width="100" height="130">' ?>

                <br>
            
                <label for="firstname">First Name:</label>
                <?php echo $firstname; ?>

                <br>

                <label for="lastname"> LastName:</label>
                <?php echo $lastname; ?>

                <br>

                <label for="gender">Gender:  </label>
                <?php echo $gender; ?>

                <br>

                <label for="phone"> Phone Number:</label>
                <?php echo $phone; ?>

                <br>

                 <label for="location">Location:  </label>
                <?php echo $location; ?>

                <br>

                <label for="email">Email:</label>
                <?php echo $email; ?>

                <div style = "text-align:right;"> <input type="submit" value="Remove Account" name="button"> </div>

                </fieldset>
                

        <div style = "text-align:center;">


        <input type="submit" value="Dashboard" name="button">

        </div>

        </form>
        
    </body>
</html>