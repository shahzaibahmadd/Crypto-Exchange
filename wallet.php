<?php
include 'config.php';
session_start();

$user_id = $_SESSION['u_id'];

if(!isset($user_id)){
    header('location:login.php');
}

$get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id'");
$balance = mysqli_fetch_assoc($get_query)['fiat_currency'];
$get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id'");
$wallet_id = mysqli_fetch_assoc($get_query)['w_id'];
$get_query = mysqli_query($conn, "SELECT cw.c_id, c.name,cw.amount, c.current_price FROM coin_wallet cw, coins c WHERE w_id = '$wallet_id' AND c.c_id = cw.c_id");
$rows = mysqli_fetch_all($get_query);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/blockchain.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
   
        <div class="container main-header">
            <a href="index.php" class="logo">
                <img src="images/blockchain.png" alt="not found">
                <h4>Project</h4>
            </a>
            <nav class="navbar">
                <span class="menu" id="menu"><i class="fas fa-bars"></i></span>
                <ul class="menu-drp" id="menu-drp">
                    <a href="index.php" class="inactive ">Home</a>
                    <a href="index.php"  class="inactive " id="btn1">About Us</a>
                    <a href="index.php" class="inactive " id="btn2">Contact Us</a>
                    <a href="wallet.php" class="inactive active" >Wallet</a>
                    <a href="buyandsell.php" class="inactive btn-nav">Buy & Sell</a>
                    <a href="endsession.php" class="inactive ">Logout</a>
                </ul>
            </nav>
        </div>
    </div>
     <div class="coin-list">
        <div class="container">
            <div class="coin-table">
                <h1><?php echo 'You Have: '.$balance.'$';?></h1>
                <table>
                    <thead>
                        <th style="width:10%;">#</th>
                        <th style="width:30%;">Name</th>
                        <th style="width:30%;">Quantity</th>
                        <th style="width:30%;">Price</th>
                    </thead>

                    

                    <?php



                        foreach($rows as $row)
                        {
                            echo 
                            '<tbody>
                            <td style="width:10%;">'.$row[0].'</td>
                            <td style="width:30%;">'.$row[1].'</td>
                            <td style="width:30%;">'.$row[2].'</td>
                            <td style="width:30%;">'.$row[3].'$</td>
                            </tbody>';
                        }


                    
                    ?>
                </table>
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
                <p>Copyright ©2022 All rights reserved | This website is designed and developed by team <a targer="_blank" href="https://webtechticians.rf.gd/index.php">tech<span>T</span>ician</a>  </p>
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