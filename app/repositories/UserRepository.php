<?php

class UserRepository {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($account_id, $full_name, $phone, $address) {

        $stmt = $this->db->prepare(
            "INSERT INTO users(account_id, full_name, phone, address)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $account_id,
            $full_name,
            $phone,
            $address
        ]);
    }
    public function update($id, $full_name, $phone, $address) {

    $stmt = $this->db->prepare(
        "UPDATE users
         SET full_name = ?, phone = ?, address = ?
         WHERE id = ?"
    );

    return $stmt->execute([
        $full_name,
        $phone,
        $address,
        $id
    ]);
    }
    public function delete($id) {

    $stmt = $this->db->prepare(
        "DELETE FROM users WHERE id = ?"
    );

    return $stmt->execute([$id]);
    }
}
?>