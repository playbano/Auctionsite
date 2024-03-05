<?php

class BidDAO
{
    private PDO $pdo;
    
    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(Bid $bid)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO bid 
                                                 (amount, userID, auctionID, comment) 
                                                 VALUES(?, ?, ?, ?)");
            $statement->bindParam(1, $bid->getAmount());
            $statement->bindParam(2, $bid->getUserID());
            $statement->bindParam(3, $bid->getAuctionID());
            $statement->bindParam(4, $bid->getComment());

            $statement->execute();
            echo "Bid added to database";
        } catch (PDOException $e) {
            echo "Issue: " . $e->getMessage();
        }
    }

    public function find(int $id): ?Bid
    {
        $statement = $this->pdo->prepare("SELECT * FROM Bid WHERE id = :id limit 1");
        $statement->bindValue(":id", $id);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, Bid::class)[0];
    }

    public function findAll(): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM Bid");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, Bid::class);
    }

    public function bidHistory($auctionId) {
        $statement = $this->pdo->prepare("SELECT Bid.amount, Bid.comment, UserT.userName
                                        FROM Bid
                                        INNER JOIN UserT ON Bid.userID=UserT.id
                                        WHERE auctionID = :id
                                        ORDER BY amount DESC
                                        LIMIT 10");
        $statement->bindValue(":id", $auctionId);
        $statement->execute();

        $bidHistory = [];

        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $bid = new Bid(
                $result['amount'],
                $result['userName'],
                $result['comment'],
            );
            $bidHistory[] = $bid;
        }
        return $bidHistory;
    }

    public function highestBid($auctionId){
        $statement = $this->pdo->prepare("SELECT amount
                                        FROM Bid WHERE auctionID = :id 
                                        ORDER BY amount DESC
                                        LIMIT 1");
        $statement->bindValue(":id", $auctionId);
        $statement->execute();

        $highestBid = $statement->fetchColumn();

        //!!Liknande exceptionhandling i alla dao-funktioner?
        //fast med ex.thr etc?
        if ($highestBid) {
            return $highestBid;
        } else {
            return null;
        }
    }
}
