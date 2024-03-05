    <?php
    session_start();
    require('header.php');
    include 'autoloader.php';

    $db = new ConnectionDb();
    $connection = $db->getConnection();

    //Om en användare inte är inloggad används boolen till att ta bort bud-knappen
    $userOnline = false;
    if (!empty($_SESSION['user_id'])) {
        $userOnline = true;
    }

    $id;
    //Tar "?id" värdet i URL'en som det nya $id värdet.
    if (!isset($_GET['id'])) {
        $id = $_SESSION['last_id'];
    }
    else    {
        $id = $_GET['id'];
        $_SESSION['last_id'] = $id;
    }

    //Tar fram den aktuella auktionen
    $auctionSubjectDAO = new AuctionSubjectDAO($connection);
    $latestAuction = $auctionSubjectDAO->find($id);

    $auctionOver = false;
    if ($latestAuction->getEndTime() < date("Y-m-d H:i:s")) {

        $auctionDAO = new AuctionDAO($connection);
        $auctionDAO->auctionComplete($id);
        $auction = $auctionDAO->find($id);
        $auction->setAuctionComplete(true);
        $auctionOver = true;
    }

    //Tar fram det högsta budet på auktionen
    $bidDAO = new BidDAO($connection);
    $highestBid = $bidDAO->highestBid($id);

    

    ?>
    <!DOCTYPE html>
    <html lang="en">
    

    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php $latestAuction->getTitle() ?></title>
    </head>

    <body>
        <link rel="stylesheet" href="style.css">
        <article id="auction-article">
            <header class="auction-h">
                <?php if ($latestAuction->getMedia() != null) { ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($latestAuction->getMedia()); ?>" />
              <?php  } ?>
                <?php
                if($auctionOver === true){
                    echo "Auktionen är avslutad <br>";
                }
                echo $latestAuction->getTitle() . " ";
                echo $latestAuction->getYear();
                ?>
            </header>
            <!--IMG-->
            <div class="auction-info">
                
                <p class="auction-p">
                    Description: <?php echo $latestAuction->getDescription(); ?></p>
                <p class="auction-bid">
                    Started at: <?php echo $latestAuction->getStartPrice(); ?><br>

                    Leading bid: <?php echo $highestBid; ?> <br>

                    Ending at: <?php echo $latestAuction->getEndTime(); ?> <br>
                    Seller: <?php $userDAO = new UserDAO($connection);
                            $seller = $userDAO->load_by_id($latestAuction->getUserID());
                            echo $seller->getUserName();
                            //kolla upp hur en timer kan skapas        
                            ?> <br>
                    AuctionID: <?php /*!! kanske inte sesh*/ echo $id; ?>
                </p>
                
                    
                
            </div>
        </article>

        

        <!--Budknappen försvinner om auktionen är avslutad eller om ingen är online-->
        <?php if ($auctionOver === false && $userOnline === true) { ?>
            <form action="AddBidView.php?id=<?php echo $id ?>" method="post">
                <input type="submit" value="Make bid">
            </form>
        <?php } ?>

        <!--Når användaren auctionen från "WonAuctionsView visas "pay"-knappen-->
        <?php if (isset($_GET['winner']) && $_GET['winner'] == 1) { ?>
            <form action="PayView.php?price=<?php echo $_GET['price'] ?>" method="post">
                <input type="submit" value="Pay"> 
            </form>
        <?php }
            else if (!isset($_GET['winner'])) {}
        ?>
        
        

                

                
         

        <?php
        //Visar budhistoriken 
        $bidHistory = $bidDAO->bidHistory($id); ?>
        <ul>
            <?php
            foreach ($bidHistory as $b) { ?>
                <li>
                    <?php echo "Amount: {$b->getAmount()} | User: {$b->getUserID()} | Comment: {$b->getComment()}"; ?>
                </li>
            <?php } ?>
        </ul>



    </body>

    </html>