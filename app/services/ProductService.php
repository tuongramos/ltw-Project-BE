<?php
class ProductService {
    private $repository;

    public function __construct() {
        $this->repository = new ProductRepository();
    }

    /**
     * Lấy tất cả sản phẩm và chuyển sang DTO
     * @return array
     */
    public function getAll() {
        $rows = $this->repository->findAll();
        return array_map(function ($row) {
            return ProductMapper::toDTO($row);
        }, $rows);
    }

    /**
     * Lấy 1 sản phẩm theo ID và chuyển sang DTO
     * @param int $id
     * @return ProductDTO|null
     */
    public function getById($id) {
        $row = $this->repository->findById($id);
        if (!$row) {
            return null;
        }
        return ProductMapper::toDTO($row);
    }

    /**
     * Lấy sản phẩm theo danh mục và chuyển sang DTO
     * @param int $categoryId
     * @return array
     */
    public function getByCategory($categoryId) {
        $rows = $this->repository->findByCategory($categoryId);
        return array_map(function ($row) {
            return ProductMapper::toDTO($row);
        }, $rows);
    }

    /**
     * Tìm kiếm sản phẩm theo từ khóa và chuyển sang DTO
     * @param string $keyword
     * @return array
     */
    public function search($keyword) {
        $rows = $this->repository->search($keyword);
        return array_map(function ($row) {
            return ProductMapper::toDTO($row);
        }, $rows);
    }

    /**
     * Tạo sản phẩm mới
     * Validate các trường bắt buộc và tự động tính discount nếu có sale_price
     * @param array $data
     * @return array - kết quả ['success' => bool, 'message' => string, 'id' => int|null]
     */
    public function create($data) {
        // Validate các trường bắt buộc
        if (empty($data['name'])) {
            return ['success' => false, 'message' => 'Tên sản phẩm là bắt buộc'];
        }
        if (empty($data['category_id'])) {
            return ['success' => false, 'message' => 'Danh mục sản phẩm là bắt buộc'];
        }
        if (!isset($data['price']) || $data['price'] <= 0) {
            return ['success' => false, 'message' => 'Giá sản phẩm là bắt buộc và phải lớn hơn 0'];
        }

        // Gán giá trị mặc định cho các trường không bắt buộc
        $data['brand'] = $data['brand'] ?? null;
        $data['description'] = $data['description'] ?? null;
        $data['sale_price'] = $data['sale_price'] ?? null;
        $data['image'] = $data['image'] ?? null;
        $data['stock'] = $data['stock'] ?? 0;
        $data['status'] = $data['status'] ?? 1;

        // Tự động tính discount nếu có sale_price
        $data['discount'] = $this->calculateDiscount($data['price'], $data['sale_price']);

        $id = $this->repository->create($data);
        if ($id) {
            return ['success' => true, 'message' => 'Thêm sản phẩm thành công', 'id' => $id];
        }
        return ['success' => false, 'message' => 'Thêm sản phẩm thất bại'];
    }

    /**
     * Cập nhật sản phẩm
     * Validate và tự động tính discount nếu có sale_price
     * @param int $id
     * @param array $data
     * @return array - kết quả ['success' => bool, 'message' => string]
     */
    public function update($id, $data) {
        // Kiểm tra sản phẩm có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return ['success' => false, 'message' => 'Sản phẩm không tồn tại'];
        }

        // Validate các trường bắt buộc
        if (empty($data['name'])) {
            return ['success' => false, 'message' => 'Tên sản phẩm là bắt buộc'];
        }
        if (empty($data['category_id'])) {
            return ['success' => false, 'message' => 'Danh mục sản phẩm là bắt buộc'];
        }
        if (!isset($data['price']) || $data['price'] <= 0) {
            return ['success' => false, 'message' => 'Giá sản phẩm là bắt buộc và phải lớn hơn 0'];
        }

        // Gán giá trị mặc định cho các trường không bắt buộc
        $data['brand'] = $data['brand'] ?? $existing['brand'];
        $data['description'] = $data['description'] ?? $existing['description'];
        $data['sale_price'] = $data['sale_price'] ?? $existing['sale_price'];
        $data['image'] = $data['image'] ?? $existing['image'];
        $data['stock'] = $data['stock'] ?? $existing['stock'];
        $data['status'] = $data['status'] ?? $existing['status'];

        // Tự động tính discount nếu có sale_price
        $data['discount'] = $this->calculateDiscount($data['price'], $data['sale_price']);

        $result = $this->repository->update($id, $data);
        if ($result) {
            return ['success' => true, 'message' => 'Cập nhật sản phẩm thành công'];
        }
        return ['success' => false, 'message' => 'Cập nhật sản phẩm thất bại'];
    }

    /**
     * Xóa sản phẩm theo ID
     * @param int $id
     * @return array - kết quả ['success' => bool, 'message' => string]
     */
    public function delete($id) {
        // Kiểm tra sản phẩm có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return ['success' => false, 'message' => 'Sản phẩm không tồn tại'];
        }

        $result = $this->repository->delete($id);
        if ($result) {
            return ['success' => true, 'message' => 'Xóa sản phẩm thành công'];
        }
        return ['success' => false, 'message' => 'Xóa sản phẩm thất bại'];
    }

    /**
     * Tự động tính phần trăm giảm giá
     * Công thức: discount = round((price - sale_price) / price * 100)
     * @param float $price
     * @param float|null $salePrice
     * @return int
     */
    private function calculateDiscount($price, $salePrice) {
        if ($salePrice && $price > 0 && $salePrice < $price) {
            return round(($price - $salePrice) / $price * 100);
        }
        return 0;
    }
}
?>
