<?php
// Ví dụ các đường dẫn (Routes)
$router->add('GET', '/', function() {
    echo json_encode(["message" => "Chào mừng bạn đến với Advanced MVC API Backend!"]);
});

// ==========================================
// KHO TÀI KHOẢN (Account)
// ==========================================
$router->add('GET', '/api/accounts', ['AccountController', 'index']);
$router->add('GET', '/api/accounts/{id}', ['AccountController', 'show']);
$router->add('POST', '/api/accounts', ['AccountController', 'store']);
$router->add('PUT', '/api/accounts/{id}', ['AccountController', 'update']);
$router->add('DELETE', '/api/accounts/{id}', ['AccountController', 'destroy']);

// ==========================================
// NGƯỜI DÙNG (User)
// ==========================================
$router->add('GET', '/api/users', ['UserController', 'index']);
$router->add('GET', '/api/users/{id}', ['UserController', 'show']);
$router->add('POST', '/api/users', ['UserController', 'store']);
$router->add('PUT', '/api/users/{id}', ['UserController', 'update']);
$router->add('DELETE', '/api/users/{id}', ['UserController', 'destroy']);

// ==========================================
// DANH MỤC (Category)
// ==========================================
$router->add('GET', '/api/categories', ['CategoryController', 'index']);
$router->add('GET', '/api/categories/{id}', ['CategoryController', 'show']);
$router->add('POST', '/api/categories', ['CategoryController', 'store']);
$router->add('PUT', '/api/categories/{id}', ['CategoryController', 'update']);
$router->add('DELETE', '/api/categories/{id}', ['CategoryController', 'destroy']);

// ==========================================
// SẢN PHẨM (Product)
// ==========================================
$router->add('GET', '/api/products', ['ProductController', 'index']);
$router->add('GET', '/api/products/{id}', ['ProductController', 'show']);
$router->add('POST', '/api/products', ['ProductController', 'store']);
$router->add('PUT', '/api/products/{id}', ['ProductController', 'update']);
$router->add('DELETE', '/api/products/{id}', ['ProductController', 'destroy']);

// ==========================================
// KHUYẾN MÃI (Promotion)
// ==========================================
$router->add('GET', '/api/promotions', ['PromotionController', 'index']);
$router->add('GET', '/api/promotions/{id}', ['PromotionController', 'show']);
$router->add('POST', '/api/promotions', ['PromotionController', 'store']);
$router->add('PUT', '/api/promotions/{id}', ['PromotionController', 'update']);
$router->add('DELETE', '/api/promotions/{id}', ['PromotionController', 'destroy']);

// ==========================================
// ĐƠN HÀNG (Order)
// ==========================================
$router->add('GET', '/api/orders', ['OrderController', 'index']);
$router->add('GET', '/api/orders/{id}', ['OrderController', 'show']);
$router->add('POST', '/api/orders', ['OrderController', 'store']);
$router->add('PUT', '/api/orders/{id}', ['OrderController', 'update']);
$router->add('DELETE', '/api/orders/{id}', ['OrderController', 'destroy']);

// ==========================================
// CHI TIẾT ĐƠN HÀNG (OrderDetail)
// ==========================================
$router->add('GET', '/api/order-details', ['OrderDetailController', 'index']);
$router->add('GET', '/api/order-details/{id}', ['OrderDetailController', 'show']);
$router->add('POST', '/api/order-details', ['OrderDetailController', 'store']);
$router->add('PUT', '/api/order-details/{id}', ['OrderDetailController', 'update']);
$router->add('DELETE', '/api/order-details/{id}', ['OrderDetailController', 'destroy']);

// ==========================================
// THANH TOÁN (Payment)
// ==========================================
$router->add('GET', '/api/payments', ['PaymentController', 'index']);
$router->add('GET', '/api/payments/{id}', ['PaymentController', 'show']);
$router->add('POST', '/api/payments', ['PaymentController', 'store']);
$router->add('PUT', '/api/payments/{id}', ['PaymentController', 'update']);
$router->add('DELETE', '/api/payments/{id}', ['PaymentController', 'destroy']);
?>
