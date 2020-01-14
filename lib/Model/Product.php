<?php


namespace Model;


class Product {

    private $id;
    private $sku;
    private $name;
    private $description;
    private $regularPrice;
    private $salePrice;
    private $soldOut;
    private $quantity;
    private $purchaseNote;
    private $hasReview;
    private $shortDescription;
    private $weight;
    private $height;
    private $length;
    private $width;
    private $productImg;
    private $gallery;

    public function __construct($row) {
        if(array_key_exists("id", $row)) { $this->id = $row['id']; }
        if(array_key_exists("sku", $row)) { $this->sku = $row["sku"]; }
        if(array_key_exists("name", $row)) { $this->name = $row["name"]; }
        if(array_key_exists("description", $row)) { $this->description = $row['description']; }
        if(array_key_exists("regularPrice", $row)) { $this->regularPrice = $row["regularPrice"]; }
        if(array_key_exists("salePrice", $row)) { $this->salePrice = $row["salePrice"]; }
        if(array_key_exists("soldOut", $row)) { $this->soldOut = $row["soldOut"]; }
        if(array_key_exists("quantity", $row)) { $this->quantity = $row["quantity"]; }
        if(array_key_exists("purchaseNote", $row)) { $this->purchaseNote = $row["purchaseNote"]; }
        if(array_key_exists("hasReview", $row)) { $this->hasReview = $row["hasReview"]; }
        if(array_key_exists("shortDescription", $row)) { $this->shortDescription = $row["shortDescription"]; }
        if(array_key_exists("weight", $row)) { $this->weight = $row["weight"]; }
        if(array_key_exists("height", $row)) { $this->height = $row["height"]; }
        if(array_key_exists("length", $row)) { $this->length = $row["length"]; }
        if(array_key_exists("width", $row)) { $this->width = $row["width"]; }
        if(array_key_exists("productImg", $row)) { $this->productImg = $row["productImg"]; }
        if(array_key_exists("gallery", $row)) { $this->gallery = $row["gallery"]; }
    }

    public function getId() { return $this->id; }

    public function getSku() { return $this->sku; }

    public function getName() { return $this->name; }

    public function getDescription() { return $this->description; }

    public function getRegularPrice() { return $this->regularPrice; }

    public function getSalePrice() { return $this->salePrice; }

    public function getSoldOut() { return $this->soldOut; }

    public function getQuantity() { return $this->quantity; }

    public function getPurchaseNote() { return $this->purchaseNote; }

    public function getHasReview() { return $this->hasReview; }

    public function getShortDescription() { return $this->shortDescription; }

    public function getWeight() { return $this->weight; }

    public function getHeight() { return $this->height; }

    public function getLength() { return $this->length; }

    public function getWidth() { return $this->width; }

    public function getProductImg() { return $this->productImg; }

    public function getGallery() { return $this->gallery; }
}