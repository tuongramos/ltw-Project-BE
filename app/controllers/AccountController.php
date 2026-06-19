<?php
class AccountController extends BaseController {
    private $service;

    public function __construct() {
        $this->service = new AccountService();
    }

    public function index() {
        $accounts = $this->service->getAll();
        $this->jsonResponse($accounts);
    }

    public function show($id) {
        // TODO: Xử lý request GET lấy 1 phần tử theo ID
        $this->jsonResponse(['message' => "Lấy thông tin Account ID $id thành công"]);
    }

    public function store() {
        // TODO: Xử lý request POST thêm mới
        $this->jsonResponse(['message' => 'Thêm mới Account thành công'], 201);
    }

    public function update($id) {
        // TODO: Xử lý request PUT cập nhật
        $this->jsonResponse(['message' => "Cập nhật Account ID $id thành công"]);
    }

    public function destroy($id) {
        // TODO: Xử lý request DELETE xóa
        $this->jsonResponse(['message' => "Xóa Account ID $id thành công"]);
    }
}
?>
