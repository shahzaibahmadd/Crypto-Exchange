<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['a_id'];



if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['delete_user']))
{
    $user_id = $_POST['delete-user_text'];

    $get_user = mysqli_query($conn, "SELECT * FROM users WHERE u_id = '$user_id'");

    if(mysqli_num_rows($get_user) > 0)
        mysqli_query($conn, "DELETE FROM users WHERE u_id = '$user_id' ") or die('user not found!');
    else
        $message[] = 'ERROR: User Does Not Exist!';
}

if(isset($_POST['add_coin']))
{
        $name = mysqli_real_escape_string($conn, $_POST['add_coin_name']);
        $path = mysqli_real_escape_string($conn, $_POST['add_coin_path']);
        $api = mysqli_real_escape_string($conn, $_POST['add_coin_api']);

        $get_query = mysqli_query($conn, "SELECT * FROM coins WHERE lower(name) = lower('$name') ");

        if(mysqli_num_rows($get_query) > 0)
        {
            $message[] = 'ERROR: Coin Already Exists!';
        }

        mysqli_query($conn, "INSERT INTO coins (name, image_path, api_id) VALUES ('$name' , '$path', '$api')") or die('failed to add coin');
        $message[] = 'SUCCESS: Coin Added Sucessfully!';

}

if(isset($_POST['add'])){

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['em']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['add']);
    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $repass = mysqli_real_escape_string($conn, md5($_POST['retypepass']));

    $user_type = 1;
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

            $message[] = 'SUCCESS: Admin Acc. Added';

        }
    }
}

$get_query_for_api = mysqli_query($conn, "SELECT * FROM coins");
$rows_api = mysqli_fetch_all($get_query_for_api);

if(isset($_POST['update_prices']))
{

    echo 'called me';


    $itr = 1;
    foreach($rows_api as $row)
    {
        $val = $_POST['field'.$itr];
        mysqli_query($conn, "UPDATE coins SET current_price = '$val' WHERE c_id = '$row[0]' ");
        $itr++;
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <style>
        body{
            margin-left:200px;
        }
    </style>
</head>
  <body>

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

  <div class="admin-main">
      <div class="sidenav" id="sd">
        <a href="index.php" class="logo">
            <img src="images/blockchain.png" alt="not found">
            <h4>Project</h4>
        </a>
        <button id="btn1" class="sidenav-inactive sidenav-active"  for="add_coin">Add Coin</button>
        <button id="btn2"  class="sidenav-inactive" for="remove">Remove User</button>
        <button id="btn3"  class="sidenav-inactive" for="add">Add Admin</button>
      </div>
  </div>
  
  <div class="admin-panel" >
    <div class="container">
        <form class="delete-coin" method = "POST" action = ""> 
            <h1>Add Coin</h1>
            <input type="text" name="add_coin_name" placeholder="Type Coin Name">
            <input type="text" name="add_coin_path" placeholder="Place your Image URL">
            <input type="text" name="add_coin_api" placeholder="Api ">


            <input type = "hidden" name = "field1" id = "i1"></input>
            <input type = "hidden" name = "field2" id = "i2"></input>
            <input type = "hidden" name = "field3" id = "i3"></input>
            <input type = "hidden" name = "field4" id = "i4"></input>
            <input type = "hidden" name = "field5" id = "i5"></input>
            <input type = "hidden" name = "field6" id = "i6"></input>
            <input type = "hidden" name = "field7" id = "i7"></input>
            <input type = "hidden" name = "field8" id = "i8"></input>


            <button type="addbutton" name="add_coin">Add</button>
            <span style = "color:aliceblue" style = "text-align:center">--------------------------------------------------------------------------------</span>
            <button type="updatebutton" name="update_prices">Update</button>
        </form>


        
    </div> 
    <div class="container">
        <form class="delete-coin" method = "POST">
            <h1>Delete User</h1>
            <input type="text" name="delete-user_text" placeholder="Type User ID">
            <button type="delbutton" name="delete_user">Delete</button>
        </form>

    </div> 
  </div>
  
  <div class="coin-list" >
    <div class="container">
        <div class="coin-table">
            <h1 style="text-align:center ; display:block ;">Users</h1>
            <table>
                <thead>
                    <th style="width:10%;">#</th>
                    <th style="width:20%;">Name</th>
                    <th style="width:20%;">Password</th>
                    <th style="width:30%;">Email</th>
                    <th style="width:30%;">CNIC</th>
                </thead>

                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM users ") or die('failed to get users');
                $rows = mysqli_fetch_all($select_users);
                foreach($rows as $row)
                    echo '<tbody>
                    <td style="width:10%;">'.$row[0].'</td>
                    <td style="width:20%;">'.$row[1].' '.$row[2].'</td>
                    <td style="width:20%;">'.$row[7].'</td>
                    <td style="width:30%;">'.$row[3].'</td>
                    <td style="width:30%;">'.$row[6].'</td>
                    </tbody>'
                
                ?>

            </table>
        </div>
    </div>
 </div>

 <div class="add-admin">
    <div class="container adm">
        <div class="adm-add">
            <h1> Add Admin</h1>
            <form for="" method="POST" action="" style="
            width: 100%;
        ">
        
                    <div class="adm-add-details">
                        <label for="first name"> First name</label>
                        <input type="text" name="fname" class="inputbox" placeholder="First name" required="">
                        <label for="last name"> Last name </label>
                        <input type="text" name="lname" class="inputbox" placeholder="Last name" required="">
                        <label for="email"> Email </label>
                        <input type="email" name="em" class="inputbox" placeholder="Email" required="">
        
                        <label for="address"> Address</label>
                        <input type="text" name="add" class="inputbox" placeholder="Address" required="">
        
        
                        <label for="dateofbirth"> Date of Birth</label>
                        <input id="test" type="date" name="dob" min="1899-01-01" max="2023-01-01" class="dobbox" required="">
        
                        <label for="cnic"> CNIC</label>
                        <input type="text" name="cnic" class="inputbox" placeholder="00000-0000000-0" required="">
        
                        <label for="password"> Password</label>
                        <input type="password" name="pass" class="inputbox" placeholder="password" required="">
        
                        <label for="retypepassword"> Retype Password</label>
                        <input type="password" name="retypepass" class="inputbox" placeholder="password" required="">
                    
                    <button type="submit" name="add">Add</button>
                </div>
        
                </form>
        </div>
    </div>
</div>
    
    <div class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-content">
                    <a href="index.php" class="logo">
                        <img src="images/blockchain.png" alt="not found">
                        <h4>Project</h4>
                    </a>
                    <p>Our aim is and has been to work with our clients in friendly manner.</p>
                     <div class="footer-links" data-aos="fade-up">
                         <a href="mailto:Handymanmcr-@hotmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
                         <a href="https://wa.me/447929393329" target="_blank"><i class="fab fa-whatsapp"></i></a>
                     </div>
                </div>
                <div class="footer-content">
                    <h1>About Us</h1>
                    <p>We provide a fundamental analysis of the crypto market. In addition to tracking price, volume and market capitalisation, we track community growth, open-source code development, major events and on-chain metrics.</p>
                </div>
                <div class="footer-content">
                    <h1>Contact Us</h1>
                    <span><i class="fad fa-map"></i>Lahore, Pakistan</span>
                    <a href="https://wa.me/9200000000000"><i class="fad fa-mobile-android"></i>+92 0000 0000000</a>
                    <a href="mailto:Project@hotmail.com"><i class="fad fa-envelope"></i>Project@hotmail.com</a>
                </div>
               
            </div>
            <div class="copyrights">
                <p>Copyright ©2022 All rights reserved | This website is designed and developed by team <a targer="_blank" href="https://webtechticians.rf.gd/index.html">tech<span>T</span>ician</a>  </p>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
   <script src="js/slick.min.js"></script> 
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

   <script>
                var get1 = document.getElementById('i1');
                var get2 = document.getElementById('i2');
                var get3 = document.getElementById('i3');
                var get4 = document.getElementById('i4');
                var get5 = document.getElementById('i5');
                var get6 = document.getElementById('i6');
                var get7 = document.getElementById('i7');
                var get8 = document.getElementById('i8');

                var liveprice = {
                "async": true,
                "scroosDomain": true,
                "url": "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum%2Cbinancecoin%2Csolana%2Cavalanche-2%2Cmatic-network%2Cdogecoin%2Ctron%2Clitecoin%2Cftx-token%2Ctether&vs_currencies=usd&include_24hr_change=true",

                "method": "GET",
                "headers": {}
                }

                $.ajax(liveprice).done(function (response){

                    get1.value = response.bitcoin.usd; 
                    get2.value = response.ethereum.usd; 
                    get3.value = response.solana.usd; 
                    get4.value = response.tron.usd;
                    get5.value = response.tether.usd;
                    get6.value = response.binancecoin.usd;
                    get7.value = response.litecoin.usd; 
                    get8.value = response.dogecoin.usd; 

                });


        </script>

<script>
    AOS.init();
</script>
<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("sd");
    var btns = header.getElementsByClassName("sidenav-inactive");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName(" sidenav-active");
      current[0].className = current[0].className.replace(" sidenav-active", "");
      this.className += " sidenav-active";
      });
    }
</script>
<script>
     $("#btn1").click(function() {
    $('html,body').animate({
        scrollTop: $(".admin-panel").offset().top},
        'slow');
});
$("#btn2").click(function() {
    $('html,body').animate({
        scrollTop: $(".coin-list").offset().top},
        'slow');
});
$("#btn3").click(function() {
    $('html,body').animate({
        scrollTop: $(".add-admin").offset().top},
        'slow');
});




</script>


</body>
</html>