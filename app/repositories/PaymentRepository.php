<?php
class PaymentRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM payments ORDER BY created_at DESC");
        $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_CLASS, Payment::class);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(Payment::class);
    }

    public function findByOrderId($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM payments WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchObject(Payment::class);
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO payments (order_id, method, amount, status, transaction_id, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $data['order_id'],
            $data['method'] ?? 'COD',
            $data['amount'],
            $data['status'] ?? 'PENDING',
            $data['transaction_id'] ?? null,
        ]);
        return $this->findById($this->db->lastInsertId());
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE payments SET method = ?, amount = ?, status = ?, transaction_id = ? WHERE id = ?
        ");
        $stmt->execute([
            $data['method'], $data['amount'], $data['status'],
            $data['transaction_id'] ?? null, $id
        ]);
        return $this->findById($id);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM payments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>