<?php
class UserService {
    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    // TODO: Viết các hàm logic nghiệp vụ, gọi hàm từ Repository
    // Ví dụ: public function getAll() { return $this->repository->findAll(); }
}
?>
