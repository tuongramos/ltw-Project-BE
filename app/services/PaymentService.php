<?php
class PaymentService {
    private $repository;

    public function __construct() {
        $this->repository = new PaymentRepository();
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function getById($id) {
        return $this->repository->findById($id);
    }

    public function getByOrderId($orderId) {
        return $this->repository->findByOrderId($orderId);
    }

    public function create($data) {
        return $this->repository->create($data);
    }

    public function update($id, $data) {
        $payment = $this->repository->findById($id);
        if (!$payment) return null;
        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        $payment = $this->repository->findById($id);
        if (!$payment) return false;
        return $this->repository->delete($id);
    }
}
?>