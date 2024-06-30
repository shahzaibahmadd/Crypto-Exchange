<?php 

include 'config.php';

if(isset($_POST['sub'])){

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['em']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['add']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $repass = mysqli_real_escape_string($conn, md5($_POST['retypepass']));

    $user_type = 0;
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('failed to check for existing user');

    if(mysqli_num_rows($select_users) > 0)
        $message[] = 'ERROR: User Already Exists!';
    else
    {
        if($pass != $repass){
            $message[] = 'ERROR: Passwords Are Not Matching!';
        }
        else{
            mysqli_query($conn, "INSERT INTO users (fname, lname, email, address, dob, cnic, pass, is_admin) VALUES ('$fname', '$lname', '$email', '$address', '$dob', '$cnic', '$repass', '$user_type')") 
            or die('failed to add user');

            $message[] = 'SUCCESS: You Have Been Registered! <a href = "login.php"> Login </a>';

        }
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



<body class="signup">

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

    <div class="signup-main" data-aos="fade-right">
        <div class="container sup">
            <div class="signup-1">
                <h1> SIGN UP</h1>
            <form action="" method="post" >

                <div class="signup-details">
                    <label for="first name"> First name</label><br>
                    <input type="text" name="fname" class="inputbox" placeholder="First name" required = 
                    "required"><br>
                    <label for="last name"> Last name </label><br>
                    <input type="text" name="lname" class="inputbox" placeholder="Last name" required = 
                    "required"><br>
                    <label for="email"> Email </label><br>
                    <input type="email" name="em" class="inputbox" placeholder="Email" required = 
                    "required"><br>

                    <label for="address"> Address</label><br>
                    <input type="text" name="add" class="inputbox" placeholder="Address" required = 
                    "required"><br>


                    <label for="dateofbirth"> Date of Birth</label><br>
                    <input id="test" type="date" name="dob" min='1899-01-01' max='2023-01-01'
                        class="dobbox" required = 
                    "required"></input><br>

                    <label for="cnic"> CNIC</label><br>
                    <input type="text" name="cnic" class="inputbox" placeholder="00000-0000000-0" required = 
                    "required"><br>

                    <label for="password"> Password</label><br>
                    <input type="password" name="pass" class="inputbox" placeholder="password" required = 
                    "required"><br>

                    <label for="retypepassword"> Retype Password</label><br>
                    <input type="password" name="retypepass" class="inputbox" placeholder="password" required = 
                    "required"><br>
                <label class="termsandcond"> <input type="checkbox" class="check" name="check_box" required = 
                    "required">I agree to the Terms and
                    Conditions</label>
                <button type="submit" name="sub">SUBMIT</button>
            </div>

            </form>
            </div>
            <div class="sidetxt" data-aos="fade-left">
                <p>JOIN<br> THE<br> FUTURE</p>
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