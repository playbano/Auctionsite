<?php


class Select
{

    public function __construct()
    {
        
    }

    public static function Newest($table_name)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, MAX(bid.amount), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY auctionsubject.id DESC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      } 
      public static function Oldest($table_name)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY auctionsubject.id ASC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      } 
      public static function AlphabetDESC($table_name)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY auctionsubject.title DESC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      } 
      public static function AlphabetASC($table_name)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY auctionsubject.title ASC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      } 
      public static function Kort($id)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject 
          INNER JOIN auction ON auctionsubject.id = auction.subjectID 
          LEFT JOIN bid ON auction.id = bid.auctionID 
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year; ";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      }
      public static function Cheapest($id)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY COALESCE(MAX(bid.amount),0) ASC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      }
      public static function Expensive($id)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year
          ORDER BY COALESCE(MAX(bid.amount),0) DESC;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      }
      public static function WonBid($id)  
      {  
          $db = new ConnectionDb();
          $con = $db->getConnection();  
          $query = "SELECT auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year, COALESCE(MAX(bid.amount),0), auctionsubject.media
          FROM auctionsubject
          INNER JOIN auction ON auctionsubject.id = auction.subjectID
          LEFT JOIN bid ON auction.id = bid.auctionID
          WHERE bid.userID = ".$id." AND auction.auctionComplete = TRUE
          GROUP BY auctionsubject.id, auctionsubject.title, auctionsubject.description, auctionsubject.year;";
          $stmt = $con->prepare($query); 
          $stmt->execute();

          return $stmt->fetchAll();
      }


     
}


?>