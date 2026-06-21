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

    $account = $this->service->getById($id);

    $this->jsonResponse($account);
    }

    public function store() {

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $this->service->create($data);

    if ($result) {
        $this->jsonResponse([
            'message' => 'Tạo tài khoản thành công'
        ], 201);
    } else {
        $this->jsonResponse([
            'message' => 'Tạo tài khoản thất bại'
        ], 400);
    }
    }

    public function update($id) {
        // TODO: Xử lý request PUT cập nhật
        $this->jsonResponse(['message' => "Cập nhật Account ID $id thành công"]);
    }

    public function destroy($id) {

    $result = $this->service->delete($id);

    if ($result) {
        $this->jsonResponse([
            'message' => "Xóa Account ID $id thành công"
        ]);
    } else {
        $this->jsonResponse([
            'message' => "Xóa thất bại"
        ], 400);
    }
}
}
?>
