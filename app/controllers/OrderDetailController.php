<?php
class OrderDetailController extends BaseController {
    private $service;

    public function __construct() {
        $this->service = new OrderDetailService();
    }

    public function index() {
        $details = $this->service->getAll();
        $result = array_map(function($d) {
            return OrderDetailMapper::toDTO($d);
        }, $details);
        $this->jsonResponse($result);
    }

    public function show($id) {
        $detail = $this->service->getById($id);
        if (!$detail) {
            $this->jsonResponse(['message' => 'Không tìm thấy chi tiết đơn hàng'], 404);
        }
        $this->jsonResponse(OrderDetailMapper::toDTO($detail));
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || empty($data['order_id']) || empty($data['product_id']) || empty($data['quantity']) || empty($data['unit_price'])) {
            $this->jsonResponse(['message' => 'Thiếu thông tin bắt buộc'], 400);
        }
        $detail = $this->service->create($data);
        $this->jsonResponse(OrderDetailMapper::toDTO($detail), 201);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $detail = $this->service->update($id, $data);
        if (!$detail) {
            $this->jsonResponse(['message' => 'Không tìm thấy chi tiết đơn hàng'], 404);
        }
        $this->jsonResponse(OrderDetailMapper::toDTO($detail));
    }

    public function destroy($id) {
        $result = $this->service->delete($id);
        if (!$result) {
            $this->jsonResponse(['message' => 'Không tìm thấy chi tiết đơn hàng'], 404);
        }
        $this->jsonResponse(['message' => "Xóa chi tiết đơn hàng ID $id thành công"]);
    }
}
?>