<?php


namespace API;


class ProductTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "product");
    }

    public function add($post, $productImage) {
        $sql = <<<SQL
INSERT INTO $this->tableName (sku, name, description, regularPrice, salePrice, soldOut, quantity, purchaseNote, hasReview, shortDescription, weight, height, length, width, productImg)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($post['sku'], $post['name'], $post['description'], $post['regular-price'], $post['sale-price'], $post['sold-out'], $post['quantity'], $post['purchase-note'], $post['allow-reviews'], $post['short-description'], $post['weight'], $post['height'], $post['length'], $post['width'], $productImage));
        if($statement->rowCount() === 0) {
            return false;
        }
        return true;
    }

    public function update($post) {
        $sql = "UPDATE ".$this->tableName." SET sku=?, name=?, shortDescription=?, regularPrice=?, description=?, weight=?, height=?, length=?, width=? WHERE id=".$post['id'];
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($post['sku'], $post['name'], $post['shortDescription'], $post['regularPrice'], $post['description'], $post['weight'], $post['height'], $post['length'], $post['width']));
        if($statement->rowCount() === 0) {
            return false;
        }
        return true;
    }

}