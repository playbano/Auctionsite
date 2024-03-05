<?php
/*
if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new mysqli(
      MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
           $db->real_escape_string($_POST['name']));

    $result = $db->query($sql);
    $row = $result->fetch_object();

    if ($row != null) {
      $hash = $row->hash;
      if (password_verify($_POST['password'], $hash)) {
        $message = 'Login successful.'

        $connection = $db->getConnection();
            $sql ="INSERT INTO usert (userName, password, balance, email, birthDate, buyer, seller) VALUES(?, ?, ?, ?, ?, ?, ?);";

?>

<?php  

class UserLogin {
    private $connection;

    public function initilize_db() {

        include_once "db_config.php";

    try { 

        $this->connection = new PDO("mysql:host=$localhost;auctionsite=$auctionsite", $email, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 
    catch(PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }
}

    public function UserAuth($email, $password) {
   
            $stmt = $this->connection->prepare("SELECT * FROM usert WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
        
            
            if ($user && password_verify($password, $user["password"])) {
                return true;
            }
            return false;
    }

}





?> 