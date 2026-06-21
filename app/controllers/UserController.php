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

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $this->service->create($data);

    if ($result) {
        $this->jsonResponse([
            'message' => 'Tạo User thành công'
        ], 201);
    } else {
        $this->jsonResponse([
            'message' => 'Tạo User thất bại'
        ], 400);
    }
    }

    public function update($id) {

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $this->service->update($id, $data);

    if ($result) {
        $this->jsonResponse([
            'message' => 'Cập nhật User thành công'
        ]);
    } else {
        $this->jsonResponse([
            'message' => 'Cập nhật User thất bại'
        ], 400);
    }
}

    public function destroy($id) {
        // TODO: Xử lý request DELETE xóa
        $this->jsonResponse(['message' => "Xóa User ID $id thành công"]);
    }
}
?>