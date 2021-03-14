<!DOCTYPE html>
<html>
    <head>
        <title>Book Request</title>
    </head>
    <body>
        <?php            

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Profile") {
                header('Location: admin_seller_profile.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Dashboard") {
                unset($_SESSION['seller_id']);
                header('Location: admin_dashboard.php');
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Change Password") {
                unset($_SESSION['seller_id']);
                header('Location: admin_change_pass.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['seller_id']);
                unset($_SESSION['user']);
                header('Location: login.php');
            }
        ?>
        
        <h1 >Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <div style = "text-align:right;">


            <input type="submit" value="Change Password" name="button">
            
            <input type="submit" value="Logout" name="button"> 

        </div>

            

                <label for="username">Search by Email:</label>
                <input type="text" name="target" id="target">
                <input type="submit" value="Search" name="button"> 

                <br>

                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Search") {
                        $log_file = fopen("customer_book_request.txt", "r");                    
                            $data = fread($log_file, filesize("customer_book_request.txt"));                    
                            fclose($log_file);
                            
                            $data_filter = explode("\n", $data);
        
                            for($i = 0; $i< count($data_filter)-1; $i++) {
        
                                $json_decode = json_decode($data_filter[$i], true);
        
                                if($_POST['target']==$json_decode['username']){
                                
                                    echo "Date:".$json_decode['date']."-->Book Name:".$json_decode['bookname']."-->Book Author:".$json_decode['bookauthor']."<br>";
                                }
                            }
                    }
                ?>

                <fieldset>
                <legend><b>Unread:</b></legend>

                <?php
                    $log_file = fopen("customer_book_request.txt", "r");                    
                    $data = fread($log_file, filesize("customer_book_request.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {
                        $json_decode = json_decode($data_filter[$i], true); 

                        if($json_decode['status']=='unread'){
                                                   
                            echo ($i+1)."-->Date:".$json_decode['date']."-->UserID:".$json_decode['username']."-->Book Name:".$json_decode['bookname']."-->Book Author:".$json_decode['bookauthor']."<br>";
                        }
                    }

                    $log_file = fopen("customer_book_request.txt", "r");
                    
                    $data = fread($log_file, filesize("customer_book_request.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    $log_filepath = "Temp.txt";

                    $log_file = fopen($log_filepath, "a");

                    for($i = 0; $i< count($data_filter)-1; $i++) {
                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['status'] == 'unread') 
                        {
                            $json_decode['status'] = 'read';
                            $usertable_encoded = json_encode($json_decode);
                            fwrite($log_file, $usertable_encoded . "\n");
                        }
                        else {
                            $usertable_encoded = json_encode($json_decode);
                            fwrite($log_file, $usertable_encoded . "\n");	
                        } 
                    }
                    fclose($log_file);

                    $log_file = fopen("Temp.txt", "r");                    
                    $data = fread($log_file, filesize("Temp.txt"));                    
                    fclose($log_file);

                    $log_file = fopen("customer_book_request.txt", "w");
                    fwrite($log_file, $data);                    
                    fclose($log_file);

                    $log_file = fopen("Temp.txt", "w");
                    fwrite($log_file, "");                    
                    fclose($log_file);

                ?>
                </fieldset>

                <fieldset>
                <legend><b>All Book Request:</b></legend>

                <?php
                    $log_file = fopen("customer_book_request.txt", "r");                    
                    $data = fread($log_file, filesize("customer_book_request.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {
                        $json_decode = json_decode($data_filter[$i], true); 

                        if($json_decode['status']=='read'){
                                                   
                            echo ($i+1)."-->Date:".$json_decode['date']."-->UserID:".$json_decode['username']."-->Book Name:".$json_decode['bookname']."-->Book Author:".$json_decode['bookauthor']."<br>";
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