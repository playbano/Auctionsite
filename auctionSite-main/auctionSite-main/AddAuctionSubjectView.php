<?php 
session_start();

include 'autoloader.php'; 
require('header.php');

//Objekt som knyter mot databasen
$db = new ConnectionDb();
$connection = $db->getConnection();

$formValid = true;
?>

<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Auction Subject</title>
</head>
<body>
<h1>Add Auction</h1><br />

<?php

$sellerID = $_SESSION["user_id"];

$titleView ="";
$yearView ="";
$descView="";
$startPriceView="";
$endTimeView="";

//Om det blivit exceptions i controllern
$validation = new ValidationController();
if (!empty($_SESSION['exceptions'])) {
    $validation->displayExceptions();
    $formValid = false;
}

if($formValid === false || !isset($_POST["submit"])) {
?>

<form action="controller/AddAuctionSubjectController.php" method="post" enctype="multipart/form-data">
    
    <label for="title">Auction title:</label><br>
    <input type="text" id="title" name="title" value="<?=$titleView?>"><br>

    <label for="year"> Year:</label><br>
    <input type="number" id="year" name="year" placeholder="1999" value="<?=$yearView?>"><br>
    
    <label for="desc">Description:</label><br>
    <textarea id="desc" name="desc"><?=$descView?></textarea><br>
    
    <label for="startprice">Start price:</label><br>
    <input type="number" id="startprice" name="startprice" value="<?=$startPriceView?>"><br>
    
    <label for="endtime">Auction end:</label><br>
    <input type="date" id="endtime" name="endtime" value="<?=$endTimeView?>"><br><br>
    
    <!--Just nu ingen funktion-->
    <input accept="image/*" type="file" name="image" id="image">
    
    <input type="submit" name="submit" value="Start">
</form>
<?php } ?>

</body>
</html>