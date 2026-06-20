<?php
class OrderDetailService {
    private $repository;

    public function __construct() {
        $this->repository = new OrderDetailRepository();
    }

    public function getAll(): array {
        return $this->repository->findAll();
    }

    public function getById($id): ?OrderDetail {
        return $this->repository->findById($id);
    }

    public function getByOrderId($orderId): array {
        return $this->repository->findByOrderId($orderId);
    }

    public function create($data) {
        // Tự tính subtotal nếu chưa có
        if (!isset($data['subtotal'])) {
            $data['subtotal'] = $data['quantity'] * $data['unit_price'];
        }
        return $this->repository->create($data);
    }

    public function update($id, $data) {
        $detail = $this->repository->findById($id);
        if (!$detail) return null;
        if (isset($data['quantity']) && isset($data['unit_price'])) {
            $data['subtotal'] = $data['quantity'] * $data['unit_price'];
        }
        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        $detail = $this->repository->findById($id);
        if (!$detail) return false;
        return $this->repository->delete($id);
    }
}
?>