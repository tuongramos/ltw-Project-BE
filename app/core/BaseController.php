<?php
class BaseController {
    // Có thể chứa các hàm hỗ trợ như jsonResponse(), parseBody()...
    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
?>
