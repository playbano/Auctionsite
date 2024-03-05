<?php

Class UserDAO{

    
    private PDO $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
      
    public function Insert(User $user){
        try {

            $statement = $this->pdo->prepare("INSERT INTO usert (userName, password, balance, email, birthDate, buyer, seller) VALUES(?, ?, ?, ?, ?, ?, ?);");

            $userName = $user->getUserName();
            $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $balance = $user->getBalance();
            $email = $user->getEmail();
            $birthDate = $user->getBirthDate();
            $buyer = $user->getBuyer();
            $seller = $user->getSeller();

            $statement->execute([$userName, $password, $balance, $email, $birthDate, $buyer, $seller]);

        } catch (PDOException $e) {
            echo "Issue: " . $e->getMessage();
        }
    }

    public function Find($email){

        $stmt = $this->pdo->prepare('SELECT id, userName, password, balance, email, birthDate, buyer, seller FROM userT WHERE email=?');
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, User::class)[0];

        if($result){ 
            return $result;
        }

    }
    public function load_by_id($id){

        $stmt = $this->pdo->prepare('SELECT userName, password, balance, email, birthDate, buyer, seller FROM userT WHERE id=?');
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, User::class)[0];

        if($result){
            return $result;
        }
    }

    public function updateBalance($bidAmount, $id) {
        try {
        $statement = $this->pdo->prepare("UPDATE UserT
                                        SET balance = balance-:bidAmount
                                        WHERE id = :id");
        $statement->bindValue(":bidAmount", $bidAmount);
        $statement->bindValue(":id", $id);
        $statement->execute();
        
        
        } catch (PDOException $e) {
            echo "Issue: " . $e->getMessage();
        }
    }
}
?>