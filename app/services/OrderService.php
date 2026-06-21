<?php
class OrderService {
    private $repository;

    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function getAll() {
        return $this->repository->findAll();
    }

    public function getById($id) {
        return $this->repository->findById($id);
    }

    public function create($data) {
        // Tạo mã đơn hàng tự động nếu chưa có
        if (empty($data['order_code'])) {
            $data['order_code'] = 'DH-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        }
        return $this->repository->create($data);
    }

    public function update($id, $data) {
        $order = $this->repository->findById($id);
        if (!$order) return null;
        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        $order = $this->repository->findById($id);
        if (!$order) return false;
        return $this->repository->delete($id);
    }
}
?>