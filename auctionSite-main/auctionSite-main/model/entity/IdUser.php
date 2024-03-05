<?php
//Class User + ID
Class IdUser extends User{
    private $ID;
    function __construct($ID, $userName, $password, $balance, $email, $birthDate, $buyer, $seller)
    {
        parent::__construct($ID, $userName, $password, $balance, $email, $birthDate, $buyer, $seller);
        $this->ID = $ID;

    }
    public function getID(){
        return $this->ID;
    }
    
}

?>