<?php
class OrderDetailRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM order_details");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'OrderDetail');
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM order_details WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('OrderDetail');
    }

    public function findByOrderId($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM order_details WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'OrderDetail');
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO order_details (order_id, product_id, product_name, product_image, quantity, unit_price, subtotal)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['order_id'],
            $data['product_id'],
            $data['product_name'],
            $data['product_image'] ?? null,
            $data['quantity'],
            $data['unit_price'],
            $data['subtotal'],
        ]);
        return $this->findById($this->db->lastInsertId());
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE order_details SET quantity = ?, unit_price = ?, subtotal = ? WHERE id = ?
        ");
        $stmt->execute([$data['quantity'], $data['unit_price'], $data['subtotal'], $id]);
        return $this->findById($id);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM order_details WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
