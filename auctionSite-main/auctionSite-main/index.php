<?php
session_start();
/*
unset($_SESSION['last_auction_id']);
unset($_SESSION['last_id']);
*/
require 'header.php';
include 'autoloader.php';

?>
<link rel="stylesheet" href="style.css">

<body>
<form action = "" method = "post">
<select name="filter" id="filter">
	<option value="Newest">Filter Auctions</option>
	<option value="Newest">Newest First</option>
	<option value="Oldest">Oldest First</option>
	<option value="AlphabetDESC">A to Ö</option>
    <option value="AlphabetASC">Ö to A</option>
    <option value="Cheapest">Cheapest First</option>
    <option value="Expensive">Expensive First</option>
</select>
<button type="submit" name="submit" value="filter">Filter</button>
</form>

<?php
if (!isset($_POST['submit'])) {

    $auctions = Select::Newest("auctionsubject");
    display($auctions);
}


if (isset($_POST['submit'])) 
    {

        $filter = $_POST['filter'];
        $auctions = Select::{$filter}("auctionsubject");

        display($auctions);
    }

?>

<?php 
function display($auctions) {
 
    foreach($auctions as $auction) { ?>
    <a href="AuctionView.php?id=<?php echo $auction[0]."&winner=".false ?>"><form>
        <?php if ($auction[5] != null) { ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($auction[5]); ?>" />
            <?php  } ?>
        
            <h3><?php echo $auction[1]?> </h3>
            
            <ul>
            <li><?php echo $auction[2]?> </li>
            <li><?php echo "Release date: ".$auction[3]?> </li>
            <li><?php echo "Current price: ".$auction[4]?> </li>
            <br>
            

            <!--Skickar $id i URL'en till AuctionView.php -->
            <!--<a href="AuctionView.php?id=<?php echo $auction[0] ?>">View</a> -->
            </ul>
            
        </form></a>
        
<?php } }?>
    




</body>







