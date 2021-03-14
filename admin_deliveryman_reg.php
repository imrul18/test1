<!DOCTYPE html>
<html>
    <head>
        <title>Delivery Man Registration Form</title>
    </head>
    <body>
        <?php

            $firstname = $lastname = $email = $phone = "";
            $emptyerr = $passerr = $notavailable = "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Submit") {

                $firstname = $_POST['fname'];
                $lastname = $_POST['lname'];
                $email = $_POST['e-mail'];
                $phone = $_POST['phone'];


                if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['gender']) || empty($_POST['e-mail']) || empty($_POST['phone']) || empty($_POST['img']) || empty($_POST['pass']) || empty($_POST['cpass'])) {
                    $emptyerr = "Please Fill up the form properly!";
                }

                else if($_POST['pass'] != $_POST['cpass']) {
                    $passerr="Password doesn't Match";
                }

                else if(strlen($_POST['pass']) <= 7) {
                    $passerr="Password Must be minimum 8 character!";
                }

                else {

                    $gender = $_POST['gender'];
                    $img = $_POST['img'];
                    $password = $_POST['pass'];

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);

                        if( $json_decode['username'] == $email) 
                        {
                            $notavailable = "Already have an Account!!!";
                        }
                        
                        }
                        if($notavailable == "")      
                        {
                            $details = array('firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'email' => $email, 'image' => $img, 'phone' => $phone) ;
                            $details_encoded = json_encode($details);

                            $filepath = "del_reg.txt";

                            $reg_file = fopen($filepath, "a");
                            fwrite($reg_file, $details_encoded . "\n");	
                            fclose($reg_file);

                            $usertable = array('username' => $email, 'password' => $password, 'type' => 'deliveryman', 'status' => 'active');
                            $usertable_encoded = json_encode($usertable);

                            $log_filepath = "Login.txt";

                            $log_file = fopen($log_filepath, "a");
                            fwrite($log_file, $usertable_encoded . "\n");	
                            fclose($log_file);

                            $_SESSION['message'] = "You have clicked on Submit button successfully";

                            header('Location: admin_dashboard.php');
                        }
                    }
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Dashboard") {
                header('Location: admin_dashboard.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Change Password") {
                header('Location: admin_change_pass.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['user']);
                header('Location: login.php');
            }
        ?>

        <h1>Registration Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">


        <div style = "text-align:right;">


            <input type="submit" value="Change Password" name="button">
            
            <input type="submit" value="Logout" name="button"> 

        </div>

            <fieldset>
                <legend><b>Basic Information:</b></legend>
            
                <label for="firstname">First Name:</label>
                <input type="text" name="fname" id="firstname" value="<?php echo $firstname; ?>">

                <br>

                <label for="lastname"> LastName:</label>
                <input type="text" name="lname" id="lastname" value="<?php echo $lastname; ?>">

                <br>

                <label for="gender">Gender:  </label>
                <input type="radio" name="gender" id="male" value="male">  
                <label for="gender">Male </label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="gender">Female </label>
                <input type="radio" name="gender" id="other" value="other">
                <label for="gender">Other </label>

                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="e-mail" value="<?php echo $email; ?>">

                <br>

                <label for="phone">Phone no::</label>
                <input type="tel" id="phn" name="phone" value="<?php echo $phone; ?>">

                <br>

                <label for="image">Upload Photo:</label>
                <input type="file" accept="image/png, image/jpeg" name="img" id="image">

            </fieldset>

            <fieldset>
                <legend><b>Account Information:</b></legend>

                <label for="password">Password:</label>
                <input type="password" name="pass" id="password">

                <br>

                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpass" id="cpassword">
                <?php echo $passerr; ?>

                <?php echo $emptyerr; ?>
                <?php echo $notavailable; ?>
                

                <br>

                <input type="submit" value="Submit" name="button"> 

                </fieldset>

        <div style = "text-align:center;">

            <input type="submit" value="Dashboard" name="button">

        </div>

                
        
    </body>
</html>


