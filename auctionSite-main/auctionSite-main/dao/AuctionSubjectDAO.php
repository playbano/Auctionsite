<?php
class AuctionSubjectDAO {

    private PDO $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

public function insert(AuctionSubject $auctionSubject)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO auctionsubject 
                                                 (title, year, description, startPrice, endTime, userID, media) 
                                                 VALUES(?, ?, ?, ?, ?, ?, ?)");

            $title = $auctionSubject->getTitle();
            $year = $auctionSubject->getYear();
            $desc = $auctionSubject->getDescription();
            $startPrice = $auctionSubject->getStartPrice();
            $endTime = $auctionSubject->getEndTime();
            $userID = $auctionSubject->getUserID();
            $media = $auctionSubject->getMedia();

            $statement->bindParam(1, $title);
            $statement->bindParam(2, $year);
            $statement->bindParam(3, $desc);
            $statement->bindParam(4, $startPrice);
            $statement->bindParam(5, $endTime);
            $statement->bindParam(6, $userID);
            $statement->bindParam(7, $media);

            $statement->execute();
            echo 'Auction subject added to database <br>';
        } catch (PDOException $e) {
            //echo "Issue: " . $e->getMessage();
            throw new exception("Insert into AuctionSubject error");
        }
    }
    
    public function find(int $id)
{
    $statement = $this->pdo->prepare("SELECT * FROM AuctionSubject WHERE id = :id");
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, AuctionSubject::class);
    return $statement->fetch();
}


//SELECT id FROM auctionsubject WHERE id = ( SELECT MAX(id) FROM auction); 

/*
public function find(int $id) {

    $statement = $this->pdo->prepare("SELECT * FROM AuctionSubject WHERE id = :id");
    $statement->bindValue(":id", $id);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        return new AuctionSubject(
            $result['title'],
            $result['year'],
            $result['description'],
            $result['startPrice'],
            $result['endTime'],
            $result['userID'],
            $result['media'],
        );
    } else {
        echo "Not found";
        return null;
    }
 } 
 */

}