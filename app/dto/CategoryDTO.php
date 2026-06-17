<?php
class CategoryDTO {
    // Các thuộc tính public để dễ dàng chuyển đổi sang JSON
    public $id;
    public $name;
    public $slug;
    public $description;

    public function __construct($id = null, $name = null, $slug = null, $description = null) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
    }
}
?>
