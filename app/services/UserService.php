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
}
?>