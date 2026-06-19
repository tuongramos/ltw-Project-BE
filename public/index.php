<?php
require_once 'bootstrap.php';

// Khởi tạo Router
$router = new Router();

// Nạp các đường dẫn API
require_once __DIR__ . '/../app/routes/api.php';

// Xử lý URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Tự động bỏ đi phần đường dẫn thư mục gốc (ví dụ: /ltw_BE/public)
$basePath = '/web_mysql/ltw-Project-BE/public';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Chạy Router
$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($uri, $method);
?>
