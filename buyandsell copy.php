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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
   
        <div class="container main-header">
            <a href="index.html" class="logo">
                <img src="images/blockchain.png" alt="not found">
                <h4>Project</h4>
            </a>
            <nav class="navbar">
                <span class="menu" id="menu"><i class="fas fa-bars"></i></span>
                <ul class="menu-drp" id="menu-drp">
                    <a href="index.php" class="inactive ">Home</a>
                    <button  class="inactive " id="btn1">About Us</button>
                    <button  class="inactive " id="btn2">Contact Us</button>
                    <a href="wallet.php" class="inactive " >Wallet</a>
                    <a href="buyandsell.php" class="inactive active btn-nav">Buy & Sell</a>
                    <a href="login.php" class="inactive ">Logout</a>
                </ul>
            </nav>
        </div>
    </div>
     <div class="buyandsellnavmain">
        <div class="container">
          <form class="buyandsellnav" id="bands" method = "POST" action = ""> 
                <label class="btn-neon bsnav bsnavactive" id="bns" for="bitcoin"> <img src="images/bitcoin (2).png" alt="source not found"> 
                    Bitcoin
                    <svg height="50" width="180">
                      <polyline points="0,0 180,0 180,50 0,50 0,00">
                      </polyline>
                    </svg>
                  </label>
                <label class="btn-neon bsnav " id="bns"for="ethereum"> <img src="images/etherum.png" alt="source not found" > Ethereum<svg height="50" width="180">
                    <polyline points="0,0 180,0 180,50 0,50 0,00">
                    </polyline>
                  </svg></label>
                <label class="btn-neon bsnav " id="bns" for="solana"> <img src="images/solana.png" alt="source not found"> Solana<svg height="50" width="180">
                    <polyline points="0,0 180,0 180,50 0,50 0,00">
                    </polyline>
                  </svg></label>
                <label class="btn-neon bsnav " id="bns"for="avalanche"> <img src="images/avalnche.png" alt="source not found" > Avalnche<svg height="50" width="180">
                    <polyline points="0,0 180,0 180,50 0,50 0,00">
                    </polyline>
                  </svg></label>
                <label class="btn-neon bsnav " id="bns" for="polygon"> <img src="images/POLYGON.png" alt="source not found"> Polygon<svg height="50" width="180">
                    <polyline points="0,0 180,0 180,50 0,50 0,00">
                    </polyline>
                  </svg></label>
                <label class="btn-neon bsnav " id="bns" for="binance"> <img src="images/BNB.png" alt="source not found"> Binance<svg height="50" width="180">
                    <polyline points="0,0 180,0 180,50 0,50 0,00">
                    </polyline>
                  </svg></label>
                  
                <input type="radio" name="hh" id="bitcoin" checked="checked">
                <input type="radio" name="hh" id="ethereum" >
                <input type="radio" name="hh" id="solana" >
                <input type="radio" name="hh" id="avalanche" >
                <input type="radio" name="hh" id="polygon" >
                <input type="radio" name="hh" id="binance" >

                <div class="new">
                    <div class="bitcoin animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/bitcoin (2).png" alt="source not found">Bitcoin</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price1"  id="" placeholder="00000" >
                                 <button name = "buy1" class="green">BUY</button>
                                 <button name = "sell1" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                    <div class="ethereum animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/etherum.png" alt="source not found">Ethereum</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price2"  id="" placeholder="00000" >
                                 <button name = "buy2" class="green">BUY</button>
                                 <button name = "sell2" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                    <div class="solana animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/solana.png" alt="source not found">Solana</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price3"  id="" placeholder="00000" >
                                 <button name = "buy3" class="green">BUY</button>
                                 <button name = "sell3" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                    <div class="avalanche animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/avalnche.png" alt="source not found">Avalanche</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price4"  id="" placeholder="00000" >
                                 <button name = "buy4" class="green">BUY</button>
                                 <button name = "sell4" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                    <div class="polygon animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/POLYGON.png" alt="source not found">Polygon</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price5"  id="" placeholder="00000" >
                                 <button name = "buy5" class="green">BUY</button>
                                 <button name = "sell5" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                    <div class="binance animate__animated animate__fadeInUp">
                        <div class="panelcoinsdetails">
                            <div class="panelcoinimg">
                              <h1><img src="images/BNB.png" alt="source not found">Binance</h1>
                              <p>Current Price :<span> 000000 $</span></p>
                            </div>
                            <div class="panelcoinbtn">
                                 <input type="text"  name="price6"  id="" placeholder="00000" >
                                 <button name = "buy6" class="green">BUY</button>
                                 <button name = "sell6" class="red">SELL</button>
                            </div>
                        </div>
                        <div class="panelcoingraphanddesc">
                            <h1>Description:</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                            <img src="images/Chart.png" alt="source not found">
                        </div>
                    </div>
                </div>
            </form>
        </div>
     </div>
     <div class="buyandsellpanel">
        <div class="container">
            
        </div>
     </div>
    <div class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-content">
                    <a href="index.html" class="logo">
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
    AOS.init();
   </script>
   <script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("bands");
    var btns = header.getElementsByClassName("bsnav");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName(" bsnavactive");
      current[0].className = current[0].className.replace(" bsnavactive", "");
      this.className += " bsnavactive";
      });
    }
</script>
</body>
</html>