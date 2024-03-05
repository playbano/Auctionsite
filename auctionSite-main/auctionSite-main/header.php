<?php
  include 'autoloader.php';
  $db = new ConnectionDb();
  $connection = $db->getConnection();

  //Om en användare inte är inloggad kan man inte komma åt vissa funktioner
$userOnline = false;
if (!empty($_SESSION['user_id'])) {
    $userOnline = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>AuctionSite</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="index.php">AuctionSite</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="WonAuctionsView.php">Won Auctions</a></li>
        <li class="nav-item"><a class="nav-link" href="CreateUserView.php">Create User</a></li>
        <li class="nav-item"><a class="nav-link" href="SearchUser.php">Search User</a></li>
        <?php if ($userOnline === true) { ?>
        <li class="nav-item"><a class="nav-link" href="AddAuctionSubjectView.php">Add Auction</a></li>
        <?php }?>
        <li class="nav-item"><a class="nav-link" href="Simon/View/view.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="Logout.php">Logout</a></li>
    </ul>
    <div><?php  try { 
                if($userOnline === true) {

                  $userDAO = new UserDAO($connection);
                  $user = $userDAO->load_by_id($_SESSION['user_id']);
                  echo $user->getUserName();
                echo " Balance: ";
                echo $user->getBalance();
                }
                else {
                  echo "No user logged in";
                }
                
               
              }
              //kanske bort da 
              catch(Exception $e){
                throw new exception("No user logged in");
              }
                ?> </div>
  </div>
</nav>
<div class="container">
  


