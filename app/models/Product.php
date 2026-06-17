<?php
class Product {
    // Thuộc tính private tương ứng với các cột trong bảng products
    private $id;
    private $category_id;
    private $name;
    private $brand;
    private $description;
    private $price;
    private $sale_price;
    private $discount;
    private $image;
    private $stock;
    private $status;
    private $created_at;
    private $updated_at;

    // ==================== GETTERS ====================

    public function getId() {
        return $this->id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getSalePrice() {
        return $this->sale_price;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getImage() {
        return $this->image;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    // ==================== SETTERS ====================

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setSalePrice($sale_price) {
        $this->sale_price = $sale_price;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
}
?>
