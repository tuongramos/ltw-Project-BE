<?php
class OrderDetailController extends BaseController {
    private $service;

    public function __construct() {
        $this->service = new OrderDetailService();
    }

    public function index() {
        // TODO: Xử lý request GET lấy danh sách
        $this->jsonResponse(['message' => 'Lấy danh sách OrderDetail thành công']);
    }

    public function show($id) {
        // TODO: Xử lý request GET lấy 1 phần tử theo ID
        $this->jsonResponse(['message' => "Lấy thông tin OrderDetail ID $id thành công"]);
    }

    public function store() {
        // TODO: Xử lý request POST thêm mới
        $this->jsonResponse(['message' => 'Thêm mới OrderDetail thành công'], 201);
    }

    public function update($id) {
        // TODO: Xử lý request PUT cập nhật
        $this->jsonResponse(['message' => "Cập nhật OrderDetail ID $id thành công"]);
    }

    public function destroy($id) {
        // TODO: Xử lý request DELETE xóa
        $this->jsonResponse(['message' => "Xóa OrderDetail ID $id thành công"]);
    }
}
?>
