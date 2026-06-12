<?php
class PromotionRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // TODO: Viết các hàm chứa câu lệnh SQL (SELECT, INSERT, UPDATE, DELETE)
    // Ví dụ: public function findAll() { ... }
}
?>
