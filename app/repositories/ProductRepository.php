<?php
class ProductRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Lấy tất cả sản phẩm kèm tên danh mục, sắp xếp mới nhất trước
     * @return array
     */
    public function findAll() {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy 1 sản phẩm theo ID kèm tên danh mục
     * @param int $id
     * @return array|false
     */
    public function findById($id) {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy danh sách sản phẩm theo danh mục
     * @param int $categoryId
     * @return array
     */
    public function findByCategory($categoryId) {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.category_id = :category_id 
                  ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Tìm kiếm sản phẩm theo tên hoặc thương hiệu
     * @param string $keyword
     * @return array
     */
    public function search($keyword) {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.name LIKE :keyword OR p.brand LIKE :keyword2 
                  ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $searchTerm, PDO::PARAM_STR);
        $stmt->bindParam(':keyword2', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm sản phẩm mới
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $query = "INSERT INTO products (category_id, name, brand, description, price, sale_price, discount, image, stock, status) 
                  VALUES (:category_id, :name, :brand, :description, :price, :sale_price, :discount, :image, :stock, :status)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':brand', $data['brand'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
        $stmt->bindParam(':sale_price', $data['sale_price'], PDO::PARAM_STR);
        $stmt->bindParam(':discount', $data['discount'], PDO::PARAM_INT);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * Cập nhật sản phẩm theo ID
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $query = "UPDATE products 
                  SET category_id = :category_id, 
                      name = :name, 
                      brand = :brand, 
                      description = :description, 
                      price = :price, 
                      sale_price = :sale_price, 
                      discount = :discount, 
                      image = :image, 
                      stock = :stock, 
                      status = :status 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':brand', $data['brand'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
        $stmt->bindParam(':sale_price', $data['sale_price'], PDO::PARAM_STR);
        $stmt->bindParam(':discount', $data['discount'], PDO::PARAM_INT);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa sản phẩm theo ID
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Đếm tổng số sản phẩm (dùng cho phân trang sau này)
     * @return int
     */
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }
}
?>
