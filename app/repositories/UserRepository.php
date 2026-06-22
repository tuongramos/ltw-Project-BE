<?php

class UserRepository {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE (is_deleted = 0 OR is_deleted IS NULL) ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? AND (is_deleted = 0 OR is_deleted IS NULL)");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND (is_deleted = 0 OR is_deleted IS NULL)");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password, $first_name, $last_name, $phone_number, $address, $sex, $role = 'USER') {
        $stmt = $this->db->prepare(
            "INSERT INTO users (username, email, password, first_name, last_name, phone_number, address, sex, role, status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')"
        );

        return $stmt->execute([
            $username,
            $email,
            $password,
            $first_name,
            $last_name,
            $phone_number,
            $address,
            $sex,
            $role
        ]);
    }

    public function update($id, $username, $email, $password, $first_name, $last_name, $phone_number, $address, $sex, $role) {
        $stmt = $this->db->prepare(
            "UPDATE users
             SET username = ?, email = ?, password = ?, first_name = ?, last_name = ?, phone_number = ?, address = ?, sex = ?, role = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $username,
            $email,
            $password,
            $first_name,
            $last_name,
            $phone_number,
            $address,
            $sex,
            $role,
            $id
        ]);
    }

    public function delete($id) {
        // Soft delete
        $stmt = $this->db->prepare("UPDATE users SET is_deleted = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>