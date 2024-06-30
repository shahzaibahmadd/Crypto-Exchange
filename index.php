<?php

include 'config.php';
session_start();

$user_id = $_SESSION['u_id'];

if(!isset($user_id)){
    header('location:login.php');
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
                <a href="index.php" class="inactive active">Home</a>
                <button  class="inactive " id="btn1">About Us</button>
                <button  class="inactive " id="btn2">Contact Us</button>
                <a href="wallet.php" class="inactive " >Wallet</a>
                <a href="buyandsell.php" class="inactive btn-nav">Buy & Sell</a>
                <a href="endsession.php" class="inactive ">Logout</a>
            </ul>
        </nav>
    </div>
</div>
<div class="about-us">
  <div class="container">
    <div class="about-us-heading"><h1>ABOUT US</h1></div>
    <div class="about-us-desc">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde voluptatibus id magni enim labore, rerum dolorum? Excepturi vel distinctio, quasi nam doloribus consequuntur cum suscipit porro nihil minima, dicta corporis.</p>
    </div>
  </div>
</div>
<div class="coins">
    <div class="container">
        <div class="coins-main">
            <h1>OUR COINS</h1>
        </div>
        <div class="coin-cards">
            <?php

                $get_query = mysqli_query($conn,"SELECT name,image_path,current_price FROM coins");
                $rows = mysqli_fetch_all($get_query);

                foreach($rows as $row)
                {
                  echo '<div class="flip-card">
                  <div class="flip-card-inner">
                    <div class="flip-card-front">
                      <img src="'.$row[1].'" alt="coinlogo" >
                      <h2>'.$row[0].'</h2>
                    </div>
                    <div class="flip-card-back">
                      <img src="images/Chart.png" alt="source not found" style="height:180px ; width:280px;"><!--place graph here-->
                      <h3>Price: <span> '.$row[2].' $ </span></h3>
                      <div class="buyandsell">
                          <a href="buyandsell.php">BUY</a><a href="buyandsell.php">SELL</a>
                      </div>
                    </div>
                  </div>
                </div>';
                }
            ?>
        </div>
    </div>
</div>
<div class="contact-me-main ">
    <h1>Contact Us</h1>
    <div class="container contact-me">
        <div class="contact">
            <i class="fad fa-map-marked-alt"></i>
            <h1>Address</h1>
            <a href="">Lahore,Pakistan
            </a>
        </div>
        <div class="contact">
            <i class="fad fa-mail-bulk"></i>
            <h1>Email</h1>
            <a href="mailto:project@hotmail.com">project@hotmail.com</a>
        </div>
        <div class="contact">
            <i class="fad fa-mobile-android"></i>
            <h1>Phone</h1>
            <a href="tel://+0000000">+92 000 0000000.</a>
        </div>
        <div class="contact">
            <i class="fad fa-globe"></i>
            <h1>Website</h1>
            <a href="index.php">xyz.com</a>
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
<script>
  // Add active class to the current button (highlight it)
  var header = document.getElementById("menu-drp");
  var btns = header.getElementsByClassName("inactive");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName(" active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
  }
</script>
<script>
 $("#btn2").click(function() {
    $('html,body').animate({
        scrollTop: $(".contact-me-main").offset().top},
        'slow');
});
$("#btn1").click(function() {
    $('html,body').animate({
        scrollTop: $(".about-us").offset().top},
        'slow');
});
</script>
</body>
</html>