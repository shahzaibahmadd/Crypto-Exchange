<?php

include 'config.php';
session_start();

$user_id = $_SESSION['u_id'];
// echo "User ID: ".$_SESSION['u_id'];

if(!isset($user_id)){
    header('location:login.php');
}

$get_query = mysqli_query($conn, "SELECT * FROM coins");
$rows = mysqli_fetch_all($get_query);

if(isset($_POST['buy']))
{
    $cid = $_POST['coinid'];
    $cq = $_POST['coinquantity'];

    $get_query = mysqli_query($conn, "SELECT *  FROM coins WHERE c_id = '$cid'");
    $cp = mysqli_fetch_assoc($get_query);

    $cost = floatval($cp['current_price']) * floatval($cq);
    
    $get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id' ");
    $balance = mysqli_fetch_assoc($get_query)['fiat_currency'];
    $newbalance = floatval($balance) - floatval($cost);
    if($newbalance < 0)
    {
        $message[] = 'ERROR: You Don\'t Have Enough Balance!!';
    }
    else
    {
        mysqli_query($conn, "UPDATE wallet SET fiat_currency = '$newbalance' WHERE u_id = '$user_id' ");

        $get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id'");
        $wallet_id = mysqli_fetch_assoc($get_query)['w_id'];

        $get_query = mysqli_query($conn, "SELECT * FROM coin_wallet WHERE c_id = '$cid' AND  w_id = '$wallet_id' ");

    
        if(mysqli_num_rows($get_query) > 0)
        {
            $curr_quantity = mysqli_fetch_assoc($get_query)['amount'];
            $new_quantity = floatval($curr_quantity) + floatval($cq);
            mysqli_query($conn, "UPDATE coin_wallet SET amount = '$new_quantity' WHERE c_id = '$cid' AND  w_id = '$wallet_id' ");
        }
        else 
        {
            // mysqli_query($conn, "INSERT INTO coin_wallet (w_id, c_id, amount) VALUES '$wallet_id', '$cid', '$cq'" );

            // Prepare the SQL statement
        $stmt = mysqli_prepare($conn, "INSERT INTO coin_wallet (w_id, c_id, amount) VALUES (?, ?, ?)");

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "iii", $wallet_id, $cid, $cq);

        // Execute the statement
        mysqli_stmt_execute($stmt);


        }

        $message[] = 'SUCCESS: Transaction Completed!!';
    }



}
if(isset($_POST['sell']))
{
    $cid = $_POST['coinid'];
    $cq = $_POST['coinquantity'];

    $get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id'");
    $wallet_id = mysqli_fetch_assoc($get_query)['w_id'];

    $get_query = mysqli_query($conn, "SELECT * FROM coin_wallet WHERE c_id = '$cid' AND  w_id = '$wallet_id' ");
    $camount = mysqli_fetch_assoc($get_query)['amount'];

    $cost =  floatval($camount) - floatval($cq);
    if($cost < 0)
    {
        $message[] = 'ERROR: You Don\'t Have Enough Coins!!';
    }
    else
    {
        mysqli_query($conn, "UPDATE coin_wallet SET amount = '$cost' WHERE  c_id = '$cid' AND  w_id = '$wallet_id' ");

        $get_query = mysqli_query($conn, "SELECT *  FROM coins WHERE c_id = '$cid'");
        $cp = mysqli_fetch_assoc($get_query)['current_price'];

        $newmoneys = floatval($cp) * floatval($cq);
        
        $get_query = mysqli_query($conn, "SELECT * FROM wallet WHERE u_id = '$user_id' ");
        $balance = mysqli_fetch_assoc($get_query)['fiat_currency'];

        $newbalance = floatval($balance) + floatval($newmoneys);

        mysqli_query($conn, "UPDATE wallet SET fiat_currency = '$newbalance' WHERE u_id = '$user_id' ");

        $message[] = 'SUCCESS: Transaction Completed!!';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
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

                <?php

                    $class = "btn-neon bsnav bsnavactive";
                    foreach($rows as $row)
                    {
                        echo '<label class="'.$class.'" id="bns" for="'.strtolower($row[1]).'"> <img src="'.$row[3].'" alt="source not found"> 
                        '.strtoupper($row[1]).'
                        <svg height="50" width="180">
                          <polyline points="0,0 180,0 180,50 0,50 0,00">
                          </polyline>
                        </svg>
                      </label>';

                      $class = "btn-neon bsnav "; 
                    }
                    
                    $checked = "checked = \"checked\"";
                    foreach($rows as $row)
                    {
                        echo '<input type="radio" name="hh" id="'.strtolower($row[1]).'" ' . $checked . '>';
                        $checked = "";
                    }
                ?>

                <div class="new">

                    <?php
                        foreach($rows as $row)
                        {
                            echo '<div class="'.strtolower($row[1]).' animate__animated animate__fadeInUp">
                            <div class="panelcoinsdetails">
                                <div class="panelcoinimg">
                                  <h1><img src="'.$row[3].'" alt="source not found">'.$row[1].'</h1>
                                  <p>Current Price :<span> '.$row[2].' $</span></p>
                                </div>
                                <div class="panelcoinbtn">
                                     <input type="text"  name="price"  id="p'.$row[0].'" placeholder="00000" >
                                     <button name = "buy" id = "'.$row[0].'" class="green" onclick = \'clicked(this.id)\'>BUY</button>
                                     <button name = "sell" id = "'.$row[0].'" class="red" onclick = \'clicked(this.id)\'>SELL</button>
                                </div>
                            </div>
                            <div class="panelcoingraphanddesc">
                                <h1>Description:</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure dolorum excepturi tenetur laborum illo reiciendis facilis error laudantium sit enim? Ipsum, voluptas tempore. Fugit voluptas nemo tempora nulla alias soluta?</p>
                                <img src="images/Chart.png" alt="source not found">
                            </div>
                        </div>';
                        }
                    ?>

                </div>

                <input type = "text" name = "coinid" id = "coin_id_field"> 
                <input type = "text" name = "coinquantity" id = "coin_price_field">
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
        function clicked(inp)
        {
            var pf = document.getElementById('p' + inp);
            var cpf = document.getElementById('coin_price_field');
            var cif = document.getElementById("coin_id_field");
            cif.value = inp;
            cpf.value = pf.value;
        }
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