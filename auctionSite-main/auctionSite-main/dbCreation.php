<?php
//Använder inte ConnectionDB klassen här för då försöker den ta in databasnamnet
//innan databasen finns. 
$pdo = new PDO("mysql:host=localhost", "username", "pinkldinkl");


try {
    $pdo->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, true);
    $dbName = "AuctionSite";

    $dbCreateQ = "CREATE DATABASE IF NOT EXISTS $dbName;
    
    USE $dbName;

    CREATE TABLE IF NOT EXISTS UserT(
        id INT AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(255),
        password VARCHAR(255),
        balance DECIMAL,
        email VARCHAR(255),
        birthDate DATETIME,
        buyer BOOLEAN,
        seller BOOLEAN
    );

    CREATE TABLE IF NOT EXISTS AuctionSubject (
        id INT AUTO_INCREMENT PRIMARY KEY,
        userID INT, 
        year INT,
        title VARCHAR(255),
        description VARCHAR(255),
        startPrice DECIMAL,   
        endTime DATETIME,
        media LONGBLOB,
        FOREIGN KEY (userID) REFERENCES UserT(id)
    );

    CREATE TABLE IF NOT EXISTS Auction (
        id INT AUTO_INCREMENT PRIMARY KEY,
        subjectID INT,
        auctionComplete BOOLEAN,
        FOREIGN KEY (subjectID) REFERENCES AuctionSubject(id)
    );

    CREATE TABLE IF NOT EXISTS Bid(
        id INT AUTO_INCREMENT PRIMARY KEY,
        userID INT,
        auctionID INT,
        amount DECIMAL,  
        comment VARCHAR(255),
        FOREIGN KEY (userID) REFERENCES UserT(id),
        FOREIGN KEY (auctionID) REFERENCES Auction(id)
    );
    ";

    $pdo->exec($dbCreateQ);
    echo "Database $dbName created";

} catch (PDOException $e) {
    echo "Issue: " . $e->getMessage();
}
?>