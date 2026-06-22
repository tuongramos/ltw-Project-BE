<?php
class ProductDTO {
    // Các thuộc tính public để trả về cho Frontend
    public $id;
    public $category_id;
    public $category_name;  // Lấy từ JOIN với bảng categories
    public $name;
    public $description;
    public $price;
    public $image_url;
    public $status;
    public $created_at;
}
?>
