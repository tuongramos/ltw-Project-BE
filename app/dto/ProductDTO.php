<?php
class ProductDTO {
    // Các thuộc tính public để trả về cho Frontend
    public $id;
    public $category_id;
    public $category_name;  // Lấy từ JOIN với bảng categories
    public $name;
    public $brand;
    public $description;
    public $price;
    public $sale_price;
    public $discount;
    public $image;
    public $stock;
}
?>
