<?php

class Auction
{
    private $id; 
    private $subjectID;     
    private $auctionComplete;

    function __construct($subjectID, $auctionComplete, $id = null){

        $this->subjectID = $subjectID;
        $this->auctionComplete = $auctionComplete;
        $this->id = $id;
    }
    //function __construct () {}

    function getID() {
        return $this->id;
    }

    function getSubjectID() {
        return $this->subjectID;
    }
    function setSubjectID($subjectID) {
        $this->subjectID = $subjectID;
    }

    function getAuctionComplete(){
        return $this->auctionComplete;
    }
    function setAuctionComplete($auctionComplete){
        $this->auctionComplete = $auctionComplete;
    }
}
