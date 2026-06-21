<?php

class UserController extends BaseController {

    private $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function index() {

        $users = $this->service->getAll();

        $this->jsonResponse($users);
    }

    public function show($id) {

    $user = $this->service->getById($id);

    $this->jsonResponse($user);
    }

    public function store() {
        // TODO: Xử lý request POST thêm mới
        $this->jsonResponse(['message' => 'Thêm mới User thành công'], 201);
    }

    public function update($id) {
        // TODO: Xử lý request PUT cập nhật
        $this->jsonResponse(['message' => "Cập nhật User ID $id thành công"]);
    }

    public function destroy($id) {
        // TODO: Xử lý request DELETE xóa
        $this->jsonResponse(['message' => "Xóa User ID $id thành công"]);
    }
}
?>