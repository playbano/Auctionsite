<?php
session_start();
include '../autoloader.php';

//Objekt som knyter mot databasen
$db = new ConnectionDb();
$connection = $db->getConnection();


$id;
if (!isset($_GET['id'])) {
    $id = $_SESSION['last_id'];
} else {
    $id = $_GET['id'];
    $_SESSION['last_id'] = $id;
}

//Används för auktionsägare och startpris
$auctionSubjDAO = new AuctionSubjectDAO($connection);
$auctionSub = $auctionSubjDAO->find($id);

//Tar fram det högsta budet på auktionen
$bidDAO = new BidDAO($connection);
$highestBid = $bidDAO->highestBid($id);


$bidAmountView = htmlspecialchars($_POST["bid"] ?? "", ENT_QUOTES);
$currentUserID = $_SESSION['user_id'];
$auctionID = $id;
$commentView = htmlspecialchars($_POST["comment"] ?? "", ENT_QUOTES);

$exceptionCollect = [];
$formComplete = false;

if (isset($_POST["submit"]) && $_POST["submit"] === "Make bid") {

    $formComplete = true;

    //Mosar in rå info från formuläret & session i objektet
    $bid = new Bid($bidAmountView, $currentUserID, $commentView, $auctionID,);

    //Kör samtliga setters som innehåller sanitering, tryblock samlar exceptions
    //Budet kan inte vara noll eller mindre (från setter)
    try {
        $bid->setAmount($bidAmountView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    //Det måste göras en kommentar på budet (från setter)
    try {
        $bid->setComment($commentView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    //Budet får inte vara lika eller mindre än det högsta budet
    try {
        if ($bid->getAmount() <= $highestBid) {
            throw new exception("Bid can not be lesser than the highest bid");
        }
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    //Budet får inte vara lika eller mindre än startpris
    try {
        if ($bid->getAmount() <= $auctionSub->getStartPrice()) {
            throw new exception("Bid can not be lesser than the start price");
        }
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    //Budet får inte skapas av auktionsägaren
    try {
        if ($bid->getUserID() === $auctionSub->getUserID()) {
            throw new exception("You can not place bid on you own auction...");
        }
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    //Budet får inte vara högre än ditt saldo
    try {
        $userDAO = new UserDAO($connection);
        $currentUser = $userDAO->load_by_id($currentUserID);

        if ($bid->getAmount() > $currentUser->getBalance()) {
            throw new exception("Balance too low");
        }
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    $validation = new ValidationController();
    $validation->setExceptions($exceptionCollect);

    //Om det finns exceptions : gör om
    if (!empty($validation->getExceptions())) {
        header("Location: ../AddBidView.php");
        exit();
    } else {

        try {
            //Om inte > skicka raden till DB, uppdatera saldo och ladda AuctionView 
            if ($formComplete === true) {

                $bidDAO->insert($bid);
                header("Location: ../AuctionView.php?id=" . $id);
                exit();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
