<?php

Class User{

    private $id;
    private $userName;
    private $password;
    private $balance;
    private $email;
    private $birthDate;
    private $buyer;
    private $seller;

    /*
    function __construct($userName, $password, $balance, $email, $birthDate, $buyer, $seller)
    {
        
        $this->userName = $userName;
        $this->password = $password;
        $this->balance = $balance;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->buyer = $buyer;
        $this->seller = $seller;
    }*/

    function __construct() {}
    
    
    public function getId() {
        return $this->id;
    }
    public function getUserName(){
        return $this->userName;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getBalance(){
        return $this->balance;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getBirthDate(){
        return $this->birthDate;
    }
    public function getBuyer(){
        return $this->buyer;
    }
    public function getSeller(){
        return $this->seller;
    }

    public function setUserName($userName){
        $this->userName = $userName;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setBalance($balance){
        $this->balance = $balance;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }
    public function setBuyer($buyer){
        $this->buyer = $buyer;
    }
    public function setSeller($seller){
        $this->seller = $seller;
    }



}
?>