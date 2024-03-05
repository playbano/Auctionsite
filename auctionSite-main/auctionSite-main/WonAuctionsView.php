<?php
session_start();
/*
unset($_SESSION['last_auction_id']);
unset($_SESSION['last_id']);
*/

require 'header.php';
include 'autoloader.php';
$_SESSION['user_id'] = 4;
$id = $_SESSION['user_id'];




?>
<link rel="stylesheet" href="style.css">

<body>
<h3>Won Auctions</h3>

<?php

    $auctions = Select::WonBid($id);
    display($auctions);
    

?>

<?php 
function display($auctions) {
    $winner = true;
 
    foreach($auctions as $auction) { ?>
    <a href="AuctionView.php?id=<?php echo $auction[0]."&winner=".true."&price=".$auction[4] ?>"><form>
        
            <h3><?php echo $auction[1]?> </h3>
            <ul>
            <li><?php echo $auction[2]?> </li>
            <li><?php echo "Release date: ".$auction[3]?> </li>
            <li><?php echo "Current price: ".$auction[4]?> </li>
            <br>

            <!--Skickar $id i URL'en till AuctionView.php -->
            <!--<a href="AuctionView.php?id=<?php echo $auction[0]."&winner=".$winner?>">View</a> -->
            </ul>
        </form></a>
        
<?php } }?>
    




</body>