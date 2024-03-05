<?php

session_start(); 

include '../autoloader.php';


$db = new ConnectionDb();
$connection = $db->getConnection();

$userName = "";
$password = "";
$balance = "";
$email = "";
$birthDate = "";
$buyer = "";
$seller = "";

if (isset($_POST['submit'])) 
{
    $ok = true;

    //Felhantering
    if(!isset($_POST['userName'])||($_POST['userName'])==='')
    {
        $ok = false;
        
    }else{
        $userName = htmlspecialchars($_POST['userName']??"",ENT_QUOTES, 'UTF-8');
    }
    if(!isset($_POST['password'])||($_POST['password'])==='')
    {
        $ok = false;
        
    }else{
        $password = htmlspecialchars($_POST['password']??"",ENT_QUOTES, 'UTF-8');
    }
    if(!isset($_POST['balance'])||($_POST['balance'])<0)
    {
        $ok = false;
        
    }else{
        $balance = htmlspecialchars($_POST['balance']??"",ENT_QUOTES, 'UTF-8');
    }
    if(!isset($_POST['email'])||($_POST['email'])==='')
    {
        $ok = false;
        
    }else{
        $email = htmlspecialchars($_POST['email']??"",ENT_QUOTES, 'UTF-8');
    }
    if(!isset($_POST['birthDate'])||($_POST['birthDate'])==='')
    {
        $ok = false;
    }
    else{
        $birthDate = htmlspecialchars($_POST['birthDate']??"",ENT_QUOTES, 'UTF-8');
    }
    if(isset($_POST['buyer'])){$buyer = 1;} else {$buyer = 0;}
    if(isset($_POST['seller'])){$seller = 1;} else {$seller = 0;}
    
    if($ok === true)
    {
        //Inserterar användaren i databasen
        $user = new User($userName, $password, $balance, $email, $birthDate, $buyer, $seller);
        $userDAO = new UserDAO($connection);
        $userDAO->Insert($user);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <h3>User added successfully</h3>
            <a href="../index.php">Menu</a>
        </body>
        </html>

        
        <?php


    }
    
    else if($ok === false){echo "Failed to add user";}
    

}

?>