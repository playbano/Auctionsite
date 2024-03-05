<?php
class AuctionTransaction {

    private PDO $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

/*function createAuctionTransac($auctionSubject) {

//Disablar autocommit och påbörjar "manuell" transac.
$this->pdo->beginTransaction();

$auctionSubjectDAO = new AuctionSubjectDAO($this->pdo);
$auctionDAO = new AuctionDAO($this->pdo);

//Det "städade" auctionSub går till databasen
$auctionSubjectDAO->insert($auctionSubject);

// Commit transaction
$this->pdo->commit();

//Skapar ett auction-objekt och skickar det till db
$lastId = $this->pdo->lastInsertId();
$auction = new Auction($lastId, false);

$_SESSION["last_id"] = $lastId; //!!Temp: Sparar id för auctionSubj
$auctionDAO->insert($auction);

$lastId = $this->pdo->lastInsertId(); 
$_SESSION["last_auction_id"] = $lastId; //!!Temp: Sparar id för auction

//Transac klar. 
$this->pdo->commit();
}}*/

function createAuctionTransac($auctionSubject) {
    try {
        // Start transaction
        $this->pdo->beginTransaction();

        $auctionSubjectDAO = new AuctionSubjectDAO($this->pdo);
        $auctionDAO = new AuctionDAO($this->pdo);

        // Insert auction subject
        $auctionSubjectDAO->insert($auctionSubject);

        // Retrieve the last inserted ID for auction subject
        $statement = $this->pdo->query("SELECT LAST_INSERT_ID()");
        $lastAuctionSubjectId = $statement->fetchColumn();

        // Insert auction
        $auction = new Auction($lastAuctionSubjectId, false);
        $auctionDAO->insert($auction);

        // Retrieve the last inserted ID for auction
        $statement = $this->pdo->query("SELECT LAST_INSERT_ID()");
        $lastAuctionId = $statement->fetchColumn();

        // Store last auction IDs in session (if needed)
        $_SESSION["last_id"] = $lastAuctionSubjectId;
        $_SESSION["last_auction_id"] = $lastAuctionId;

        // Commit transaction
        $this->pdo->commit();

        // Return any necessary data or indicate success
        return true;
    } catch (Exception $e) {
        // Rollback transaction on error
        $this->pdo->rollBack();

        // Handle or log the exception
        echo "Transaction failed: " . $e->getMessage();
        return false; // or throw $e; depending on your error handling strategy
    }
}}


?>