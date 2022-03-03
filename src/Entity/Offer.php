<?php 

class Offer {
    public static $TABLE_NAME = 'Offer';
    public static $PRIMARY_KEY = 'id';

    private $id;
    private $title;
    private $content;
    private $price;
    private $place;

    private $publicationDate;
    private $category;
    public $userId;


    // public function __construct($title, $content, $price, $place, $date) {
    //     $this->title = $title;
    //     $this->content = $content;
    //     $this->price = $price;
    //     $this->place = $place;
    //     $this->publicationDate = $date;
    // }

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string {
        return $this->content;
    }
    public function setContent(string $content) {
        $this->content = $content;
        return $this;
    }


    public function getPrice(): float {
        return $this->price;
    }
    public function setPrice(float $price) {
        $this->price = $price;
        return $this;
    }

    
    public function getPlace(){
        return $this->place;
    }
    public function setPlace($place) {
        $this->place = $place;
        return $this;
    }

    public function getPublicationDate() {
        return $this->publicationDate;
    }
    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;
        return $this;
    }
    
    //???SELECT ? JOINTURE ?
    public function getCategory() {
        return $this->category;
    }
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
}