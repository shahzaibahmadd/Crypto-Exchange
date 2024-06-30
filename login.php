<?php 

include 'config.php';
session_start();

if(isset($_POST['sublogin'])){

   
    $email = mysqli_real_escape_string($conn, $_POST['loginem']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['loginpass']));

    $user_type = 0;
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND pass = '$pass'") or die('failed to check for existing user');

    if(mysqli_num_rows($select_users) > 0)
    {
        $row = mysqli_fetch_assoc($select_users);
        if($row['is_admin'] == 1)
        {
            $_SESSION['fname'] = $row['fname'] . ' ' . $row['lname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['a_id'] = $row['a_id'];
            header('location:admin.php');
        }
        elseif($row['is_admin'] == 0)
        {
            $_SESSION['fname'] = $row['fname'] . ' ' . $row['lname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['u_id'] = $row['u_id'];
            header('location:index.php');

        }
    }
    else
    {
        $message[] = 'ERROR: Password OR Email Was Incorrect!';
    }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/blockchain.png">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body class="login">

    <?php 
        if(isset($message))
        {
            foreach($message as $message)
            {
                echo '    <div class = "pop-up-message">
                <span>'.$message.' </span>
                <i class = "fas fa-times" onclick = "this.parentElement.remove();"></i>
                 </div>';
            }
        }
    ?>

    <div class="login-form-main">
        <div class="container lgm">
            <div class="login-form">

                <h1> Log in</h1>
                <form method="post" action="">
    
                    <div class="login-details">
                        <label for=""> Email </label>
                        <input type="email" name="loginem" class="inputbox" placeholder="Email" required>
    
                        <label for=""> Password</label>
                        <input type="password" name="loginpass" class="inputbox" placeholder="Password" required>
                   
    
                    <button type="submitlogin" name="sublogin">SUBMIT</button>
    
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
                </form>
    
            </div>
        </div>
    </div>
    

    <script src="js/jquery.js"></script>
    <script src="js/slick.min.js"></script>
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>