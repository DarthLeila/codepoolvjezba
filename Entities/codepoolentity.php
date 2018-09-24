<?php
class CodepoolEntity
{
    public $id;
    public $name;
    public $type;
    public $price;
    public $city;
    public $country;
    public $image;
    public $review;
    
    function __construct($id, $name, $type, $price, $city, $country, $image, $review) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->city = $city;
        $this->country = $country;
        $this->image = $image;
        $this->review = $review;
    }
}
?>

