<?php
$host = "localhost";
$db_name = "sport_shop"; 
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8"); 
} catch(PDOException $exception) {
    echo json_encode(["status" => "error", "message" => "Lỗi kết nối CSDL: " . $exception->getMessage()]);
    exit();
}
?>
