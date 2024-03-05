<?php
session_start();
include '../autoloader.php';

//Objekt som knyter mot databasen
$db = new ConnectionDb();
$connection = $db->getConnection();

//Binder phpvariabler till forminputen med superglobals (post) 
$titleView = htmlspecialchars($_POST["title"] ?? "", ENT_QUOTES);
$yearView = htmlspecialchars($_POST["year"] ?? "", ENT_QUOTES);
$descView = htmlspecialchars($_POST["desc"] ?? "", ENT_QUOTES);
$startPriceView = htmlspecialchars($_POST["startprice"] ?? "", ENT_QUOTES);
$endTimeView = htmlspecialchars($_POST["endtime"] ?? "", ENT_QUOTES);
$sellerID = $_SESSION["user_id"];
$imgData = null;
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $imgData = file_get_contents($_FILES['image']['tmp_name']);
        $imgType = $_FILES['image']['type'];

    }
}




$exceptionCollect = []; //Fylls på när formuläret är fel ifyllt

//När formuläret är ifyllt:
if (isset($_POST["submit"]) && $_POST["submit"] === "Start") {

    //Rå info från formuläret i objektet
    $auctionSubject = new AuctionSubject($titleView, $yearView, $descView, $startPriceView, $endTimeView, $sellerID, $imgData);

    //Kör samtliga setters som innehåller sanitering
    try {
        $auctionSubject->setTitle($titleView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    try {
        $auctionSubject->setYear($yearView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    try {
        $auctionSubject->setDescription($descView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    try {
        $auctionSubject->setStartPrice($startPriceView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    try {
        $auctionSubject->setEndTime($endTimeView);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    try {
        $auctionSubject->setUserID($sellerID);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }
    try {
        $auctionSubject->setMedia($imgData);
    } catch (Exception $e) {
        $exceptionCollect[] = $e;
    }

    $validation = new ValidationController();
    $validation->setExceptions($exceptionCollect);

    //Om det finns exceptions : gör om
    if (!empty($validation->getExceptions())) {
        header("Location: ../AddAuctionSubjectView.php");
        exit();

    } else { //Om inte: kör transac 
        try {

            $transac = new AuctionTransaction($connection);
            $transac->createAuctionTransac($auctionSubject);

            header("Location: ../AuctionView.php");
            exit();
        } catch (PDOException $e) {
            $connection->rollBack();
            echo "Issue: " . $e->getMessage();
        }
    }
}
