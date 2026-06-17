<?php
class CategoryService {
    private $repository;

    public function __construct() {
        $this->repository = new CategoryRepository();
    }

    /**
     * Lấy tất cả danh mục, chuyển đổi sang DTO
     * @return array - Mảng các CategoryDTO
     */
    public function getAll() {
        $rows = $this->repository->findAll();
        $dtos = [];
        foreach ($rows as $row) {
            $dtos[] = CategoryMapper::toDTO($row);
        }
        return $dtos;
    }

    /**
     * Lấy danh mục theo ID, chuyển đổi sang DTO
     * @param int $id - ID của danh mục
     * @return CategoryDTO|null - DTO hoặc null nếu không tìm thấy
     */
    public function getById($id) {
        $row = $this->repository->findById($id);
        if (!$row) {
            return null;
        }
        return CategoryMapper::toDTO($row);
    }

    /**
     * Tạo mới danh mục
     * @param array $data - Dữ liệu từ request (name, slug, description)
     * @return CategoryDTO - DTO của danh mục vừa tạo
     * @throws Exception - Nếu thiếu dữ liệu bắt buộc
     */
    public function create($data) {
        // Validate dữ liệu bắt buộc
        if (empty($data['name'])) {
            throw new Exception('Tên danh mục không được để trống');
        }
        if (empty($data['slug'])) {
            throw new Exception('Slug không được để trống');
        }

        // Chuẩn bị dữ liệu để lưu
        $categoryData = [
            'name' => trim($data['name']),
            'slug' => trim($data['slug']),
            'description' => isset($data['description']) ? trim($data['description']) : null
        ];

        $row = $this->repository->create($categoryData);
        return CategoryMapper::toDTO($row);
    }

    /**
     * Cập nhật danh mục theo ID
     * @param int $id - ID của danh mục cần cập nhật
     * @param array $data - Dữ liệu cập nhật
     * @return CategoryDTO|null - DTO sau khi cập nhật hoặc null nếu không tìm thấy
     * @throws Exception - Nếu thiếu dữ liệu bắt buộc
     */
    public function update($id, $data) {
        // Kiểm tra danh mục có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return null;
        }

        // Validate dữ liệu bắt buộc
        if (empty($data['name'])) {
            throw new Exception('Tên danh mục không được để trống');
        }
        if (empty($data['slug'])) {
            throw new Exception('Slug không được để trống');
        }

        // Chuẩn bị dữ liệu để cập nhật
        $categoryData = [
            'name' => trim($data['name']),
            'slug' => trim($data['slug']),
            'description' => isset($data['description']) ? trim($data['description']) : null
        ];

        $row = $this->repository->update($id, $categoryData);
        return CategoryMapper::toDTO($row);
    }

    /**
     * Xóa danh mục theo ID
     * @param int $id - ID của danh mục cần xóa
     * @return bool - true nếu xóa thành công, false nếu không tìm thấy
     */
    public function delete($id) {
        // Kiểm tra danh mục có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return false;
        }

        return $this->repository->delete($id);
    }
}
?>
