<?php
class AccountRepository {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM accounts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password, $role) {
        $stmt = $this->db->prepare(
            "INSERT INTO accounts(username, email, password, role)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $username,
            $email,
            $password,
            $role
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM accounts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function update($id, $username, $email, $password, $role) {

    $stmt = $this->db->prepare(
        "UPDATE accounts
         SET username = ?, email = ?, password = ?, role = ?
         WHERE id = ?"
    );

    return $stmt->execute([
        $username,
        $email,
        $password,
        $role,
        $id
    ]);
}
}
?>