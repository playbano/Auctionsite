
<?php

session_start();
require 'header.php';
include 'autoloader.php';



    $id = $_SESSION['user_id'];
    
    $bid = $_GET['price'];

    $userDAO = new UserDAO($connection);
    //Hittar ej dessa!
    $userDAO->updateBalance($bid, $id);


    echo "New Balance: ".$userDAO->load_by_id($id)->getBalance();


?>
<link rel="stylesheet" href="style.css">