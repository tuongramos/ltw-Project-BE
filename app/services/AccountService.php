<?php
class AccountService {

    private $repository;

    public function __construct() {
        $this->repository = new AccountRepository();
    }

    public function getAll() {
        return $this->repository->findAll();
    }
    public function getById($id) {
    return $this->repository->findById($id);
    }
    public function create($data) {
    return $this->repository->create(
        $data['username'],
        $data['email'],
        $data['password'],
        $data['role'] ?? 'USER'
    );
    }
    public function delete($id) {
    return $this->repository->delete($id);
    }
    public function update($id, $data) {

    return $this->repository->update(
        $id,
        $data['username'],
        $data['email'],
        $data['password'],
        $data['role']
    );
}
}
?>
