<?php

class AuctionSubject
{
    private $title;     
    private $year;      
    private $description; 
    private $startPrice; 
    private $endTime;
    private $userID;

    private $id;
    private $media;

    /*function __construct($title, $year, $description, $startPrice, $endTime, $userID, $id = null, $media = null)
    {
        $this->title = $title;
        $this->year = $year;
        $this->description = $description;
        $this->startPrice = $startPrice;
        $this->endTime = $endTime;
        
        $this->id = $id;
        $this->userID = $userID;
        $this->media = $media;

    }*/
    
    function __construct () {}

    public function getId(){ 
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        if (trim($title) === "") {
            throw new exception("Title can not be empty");
            return false;
        } else {
            return $this->title = $title;
        }
    }

    public function getYear(){
        return $this->year;
    }
    public function setYear($year){
        if($year < 1600 || $year > date('Y')) {
            throw new exception("Year invalid");
            return false;
        }
        else { 
            return $this->year = $year;
        }
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        if (trim($description) === "") {
            throw new exception("Description missing");
            return false;
        } else {
            return $this->description = $description;
        }
    }

    public function getStartPrice(){
        return $this->startPrice;
    }
    public function setStartPrice($startPrice){
        if($startPrice < 0) {
            throw new exception("Start price can not be negative");
            return false;
        }
        if($startPrice > 999) {
            throw new exception("Start price too high");
            return false;
        }
        else { 
        return $this->startPrice = $startPrice;
        }
    }

    public function getEndTime(){
        return $this->endTime;
    }
    public function setEndTime($endTime){
        $currentDate = date("Y-m-d");
        if ($endTime < $currentDate ) {
            throw new exception("End date can not be in the past");
            return false;
        }
        else {
            return $this->endTime = $endTime;
        }
    }

    public function getUserID() {
        return $this->userID;
    }
    public function setUserID($userID){
        $this->userID = $userID;
    }

    public function getMedia() {
        return $this->media;
    }
    public function setMedia($media){
        $this->media = $media;
    }
}


