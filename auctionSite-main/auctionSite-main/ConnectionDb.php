<?php 
class ConnectionDb {
    private $serverName = "localhost";
    private $userName = "username";
    private $password = "pinkldinkl";
    private $dbName = "AuctionSite";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Issue: " . $e->getMessage();
            exit();
        }
    }
    public function getDbName() {
        return $this->dbName;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}
?>

