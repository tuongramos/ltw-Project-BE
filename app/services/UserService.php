<?php

class UserService {

    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function getById($id) {
        return $this->repository->findById($id);
    }

    public function create($data) {

        return $this->repository->create(
            $data['account_id'],
            $data['full_name'],
            $data['phone'],
            $data['address']
        );
    }
    public function update($id, $data) {

    return $this->repository->update(
        $id,
        $data['full_name'],
        $data['phone'],
        $data['address']
    );
    }
    public function delete($id) {

    return $this->repository->delete($id);
}
}
?>