<?php session_start();
require('header.php');
include 'autoloader.php';

$db = new ConnectionDb();
$connection = $db->getConnection();

$formValid = true;

$id;
if (!isset($_GET['id'])) {
    $id = $_SESSION['last_id'];
} else {
    $id = $_GET['id'];
    $_SESSION['last_id'] = $id;
}

//Displaya auktionsägare och startpris 
$auctionSubjDAO = new AuctionSubjectDAO($connection);
$auctionSub = $auctionSubjDAO->find($id);

//Displaya det högsta budet på auktionen
$bidDAO = new BidDAO($connection);
$highestBid = $bidDAO->highestBid($id);
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $bidAmountView = "";
    $commentView = "";

    //Om det blivit exceptions i controllern
    $validation = new ValidationController();
    if (!empty($_SESSION['exceptions'])) {
        $validation->displayExceptions();
        $formValid = false;
    }

    if ($formValid === false || !isset($_POST["submit"])) { ?>
    
        <form action="controller/AddBidController.php" method="post">

            <p class="highest-bid">Leading bid: <?php echo (empty($highestBid) ?
                                                    $auctionSub->getStartPrice() : $highestBid); ?>
            </p>

            <label for="bid">Bid: </label><br>
            <input type="number" id="bid" name="bid" value="<?= $bidAmountView ?>"><br>

            <label for="comment">Comment: </label><br>
            <textarea type="text" id="comment" name="comment" placeholder="" value="<?= $commentView ?>"></textarea><br>

            <input type="submit" name="submit" value="Make bid">
        </form>

    <?php  }
    ?>

</body>

</html>