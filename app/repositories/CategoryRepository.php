<?php
class CategoryRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Lấy tất cả danh mục
     * @return array - Mảng các dòng dữ liệu từ bảng categories
     */
    public function findAll() {
        $query = "SELECT * FROM categories ORDER BY id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Tìm danh mục theo ID
     * @param int $id - ID của danh mục
     * @return array|false - Dữ liệu danh mục hoặc false nếu không tìm thấy
     */
    public function findById($id) {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Tạo mới danh mục
     * @param array $data - Dữ liệu danh mục (name, slug, description)
     * @return array|false - Dữ liệu danh mục vừa tạo hoặc false nếu thất bại
     */
    public function create($data) {
        $query = "INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();

        // Trả về dữ liệu danh mục vừa tạo
        $lastId = $this->db->lastInsertId();
        return $this->findById($lastId);
    }

    /**
     * Cập nhật danh mục theo ID
     * @param int $id - ID của danh mục cần cập nhật
     * @param array $data - Dữ liệu cập nhật (name, slug, description)
     * @return array|false - Dữ liệu danh mục sau khi cập nhật hoặc false
     */
    public function update($id, $data) {
        $query = "UPDATE categories SET name = :name, slug = :slug, description = :description WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về dữ liệu danh mục sau khi cập nhật
        return $this->findById($id);
    }

    /**
     * Xóa danh mục theo ID
     * @param int $id - ID của danh mục cần xóa
     * @return bool - true nếu xóa thành công
     */
    public function delete($id) {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>
