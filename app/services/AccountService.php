<?php
class AccountService {

    private $repository;

    public function __construct() {
        $this->repository = new AccountRepository();
    }

    public function getAll() {
        return $this->repository->findAll();
    }
}
?>
