<?php
class AccountService {
    private $repository;

    public function __construct() {
        $this->repository = new AccountRepository();
    }

    // TODO: Viết các hàm logic nghiệp vụ, gọi hàm từ Repository
    // Ví dụ: public function getAll() { return $this->repository->findAll(); }
}
?>
