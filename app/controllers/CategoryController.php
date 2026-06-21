<?php
class CategoryController extends BaseController {
    private $service;

    public function __construct() {
        $this->service = new CategoryService();
    }

    public function index() {
        // TODO: Xử lý request GET lấy danh sách
        $this->jsonResponse(['message' => 'Lấy danh sách Category thành công']);
    }

    public function show($id) {
        // TODO: Xử lý request GET lấy 1 phần tử theo ID
        $this->jsonResponse(['message' => "Lấy thông tin Category ID $id thành công"]);
    }

    public function store() {
        // TODO: Xử lý request POST thêm mới
        $this->jsonResponse(['message' => 'Thêm mới Category thành công'], 201);
    }

    public function update($id) {
        // TODO: Xử lý request PUT cập nhật
        $this->jsonResponse(['message' => "Cập nhật Category ID $id thành công"]);
    }

    public function destroy($id) {
        // TODO: Xử lý request DELETE xóa
        $this->jsonResponse(['message' => "Xóa Category ID $id thành công"]);
    }
}
?>
