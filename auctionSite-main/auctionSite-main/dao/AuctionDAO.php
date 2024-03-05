<?php 
class AuctionDAO
{
    private PDO $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(Auction $auction)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO Auction 
                                                 (subjectID, auctionComplete) 
                                                 VALUES(?, ?)");
            $subjectID = $auction->getSubjectID();
            $auctionComplete = $auction->getAuctionComplete();
            
            $statement->bindParam(1, $subjectID);
            $statement->bindParam(2, $auctionComplete);

            $statement->execute();
            echo 'Auction added to database <br>';
        } catch (PDOException $e) {
            //echo "Issue: " . $e->getMessage();
            throw new exception("Insert into Auction error");
        }
    }

    /*
    public function find(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM Auction WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Auction::class);
        return $statement->fetch();
    }
    */

    public function auctionComplete(int $id){
        $statement = $this->pdo->prepare("UPDATE Auction 
                                        SET auctionComplete = TRUE 
                                        WHERE id = :id");

        $statement->bindValue(":id", $id);
        $statement->execute();
    }
    
    public function find(int $id) {
        
        $statement = $this->pdo->prepare("SELECT * FROM Auction WHERE id = :id");
        $statement->bindValue(":id", $id);
        
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new Auction(
                $result['subjectID'],
                $result['auctionComplete'],
            );
        } else {
            echo "Not found";
            return null;
        }
    } 
    
}
    ?>