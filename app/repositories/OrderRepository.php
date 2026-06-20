<?php
class OrderRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('Order');
    }

    public function findByStatus($status) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE status = ? ORDER BY created_at DESC");
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO orders (order_code, customer_name, customer_phone, customer_email,
                shipping_address, status, total_amount, discount_amount, final_amount,
                promotion_code, note, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $data['order_code'],
            $data['customer_name'],
            $data['customer_phone'],
            $data['customer_email'] ?? null,
            $data['shipping_address'],
            $data['status'] ?? 'PENDING',
            $data['total_amount'] ?? 0,
            $data['discount_amount'] ?? 0,
            $data['final_amount'] ?? 0,
            $data['promotion_code'] ?? null,
            $data['note'] ?? null,
        ]);
        return $this->findById($this->db->lastInsertId());
    }

    public function update($id, $data) {
        $fields = [];
        $values = [];
        foreach (['customer_name','customer_phone','customer_email','shipping_address',
                  'status','total_amount','discount_amount','final_amount','promotion_code','note'] as $col) {
            if (isset($data[$col])) {
                $fields[] = "$col = ?";
                $values[] = $data[$col];
            }
        }
        if (empty($fields)) return $this->findById($id);
        $values[] = $id;
        $stmt = $this->db->prepare("UPDATE orders SET " . implode(', ', $fields) . " WHERE id = ?");
        $stmt->execute($values);
        return $this->findById($id);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>