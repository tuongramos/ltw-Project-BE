<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        try {
            if (isset($_GET['id'])) {
                $query = "SELECT * FROM Product WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $_GET['id']);
            } else {
                // Lấy tất cả sản phẩm
                $query = "SELECT * FROM Product";
                $stmt = $conn->prepare($query);
            }
            
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($data) > 0) {
                echo json_encode(["status" => "success", "data" => $data]);
            } else {
                echo json_encode(["status" => "error", "message" => "Không tìm thấy sản phẩm nào."]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'POST':
        try {
            $data = json_decode(file_get_contents("php://input"));

            if(isset($data->name) && isset($data->price) && isset($data->categoryId)) {
                $query = "INSERT INTO Product (name, description, price, stockQuantity, imageUrl, status, categoryId) 
                          VALUES (:name, :description, :price, :stockQuantity, :imageUrl, :status, :categoryId)";
                
                $stmt = $conn->prepare($query);
                
                $stmt->bindParam(':name', $data->name);
                $stmt->bindParam(':description', $data->description);
                $stmt->bindParam(':price', $data->price);
                $stmt->bindParam(':stockQuantity', $data->stockQuantity);
                $stmt->bindParam(':imageUrl', $data->imageUrl);
                $stmt->bindParam(':status', $data->status);
                $stmt->bindParam(':categoryId', $data->categoryId);

                if($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Thêm sản phẩm thành công!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi thêm sản phẩm."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Vui lòng nhập đủ thông tin bắt buộc (name, price, categoryId)."]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'PUT':
        try {
            $data = json_decode(file_get_contents("php://input"));

            if(isset($data->id)) {
                $query = "UPDATE Product SET 
                            name = :name, 
                            description = :description, 
                            price = :price, 
                            stockQuantity = :stockQuantity, 
                            imageUrl = :imageUrl, 
                            status = :status, 
                            categoryId = :categoryId
                          WHERE id = :id";
                
                $stmt = $conn->prepare($query);
                
                $stmt->bindParam(':id', $data->id);
                $stmt->bindParam(':name', $data->name);
                $stmt->bindParam(':description', $data->description);
                $stmt->bindParam(':price', $data->price);
                $stmt->bindParam(':stockQuantity', $data->stockQuantity);
                $stmt->bindParam(':imageUrl', $data->imageUrl);
                $stmt->bindParam(':status', $data->status);
                $stmt->bindParam(':categoryId', $data->categoryId);

                if($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Cập nhật sản phẩm thành công!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi cập nhật sản phẩm."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Thiếu ID sản phẩm cần sửa."]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        try {
            $data = json_decode(file_get_contents("php://input"));

            if(isset($data->id)) {
                $query = "DELETE FROM Product WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $data->id);

                if($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Đã xóa sản phẩm thành công!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi xóa sản phẩm."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Thiếu ID sản phẩm cần xóa."]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Phương thức không được hỗ trợ!"]);
        break;
}
?>