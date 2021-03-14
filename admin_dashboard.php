<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
    </head>
    <body>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Login") {
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Seller Registration Request") {
                header('Location: admin_seller_reg_req.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Manage Customer") {
                header('Location: admin_customer_list.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Manage Seller") {
                header('Location: admin_seller_list.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Manage Deliveryman") {
                header('Location: admin_deliveryman_list.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Login") {
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Login") {
            }

           if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Login") {
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Book Request") {
                header('Location: admin_book_request.php');
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Feedback") {
                header('Location: admin_feedback.php');
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Change Password") {
                header('Location: admin_change_pass.php');
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['user']);
                header('Location: login.php');
            }
        ?>
        

        <h1 >Welcome to Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <div style = "text-align:right;">


            <input type="submit" value="Change Password" name="button">
            
            <input type="submit" value="Logout" name="button"> 

            </div>

        <div style= "text-align:center";>

            <fieldset>
                <legend style= "width: 300px;"><b>Dashboard</b></legend>
                
                <input style= "width: 200px;" type="submit" value="Manage Category" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Seller Registration Request" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Manage Customer" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Manage Seller" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Manage Deliveryman" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Account" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Manage Order" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Order History" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Book Request" name="button"> <br><br>
                
                <input style= "width: 200px;" type="submit" value="Feedback" name="button"> <br><br>
                
                
                </fieldset>
        </form>

        </div>
        
    </body>
</html>