<?php

class Bid {
    private $id;        //auto-inkr
    private $amount;    //int
    private $comment;   //string
    private $auctionID;  //FK (auto-inkr)
    private $userID;     //FK (auto-inkr)

    function __construct($amount, $userID, $comment, $auctionID = null, $id = null){
        $this->amount = $amount;    
        $this->userID = $userID;
        $this->auctionID = $auctionID;
        $this->comment = $comment;
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function getAmount(){
        return $this->amount;
    }
    function setAmount($amount){
        if ($amount <= 0) {
            throw new exception("Bid can not be zero or negative");
            return false;
        } else {
            return $this->amount = $amount;
        }
    }

    function getUserID(){
        return $this->userID;
    }
    function setUserID($userID){
        $this->userID = $userID;
    }

    function getAuctionID(){
        return $this->auctionID;
    }
    function setAuctionID($auctionID){
        $this->auctionID = $auctionID;
    }

    function getComment(){
        return $this->comment;
    }
    function setComment($comment){
        if(empty($comment)) {
            throw new exception("Comment can not be empty");
            return false;
        }
        else {

            /*
            //ProfanityFilter!!!
            //Meningar Funkar ej!!!

            //PHP cURL 
            $curl = curl_init();

            //Sätter upp URl, Headers(apinyckel, getformat)
            curl_setopt($curl, CURLOPT_URL, "https://api.api-ninjas.com/v1/profanityfilter?text=".$comment);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('response-type: application/json','X-Api-Key: eGWBvp8HhoiZzO1LkCmYkw==6Iz9DE5PvnqD5U2X')); //'APIKEY: eGWBvp8HhoiZzO1LkCmYkw==6Iz9DE5PvnqD5U2X'

            //response = [orginal text, censored text, profanity true/false] 
            $response = curl_exec($curl);
            if($e = curl_error($curl)) {
                echo $e;
            } else {

            //Gör om response till array
            $decodedData = 
                json_decode($response, true);   
            }
            
            // stänger cURL
            curl_close($curl);

           
            //Nya comment är den censurerade texten
            var_dump($decodedData[1]);
            

            $this->comment = htmlspecialchars($decodedData[1]);
            */    

           $this->comment = $comment;

        }
    }

}
