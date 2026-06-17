<?php
class CategoryMapper {

    /**
     * Chuyển đổi từ dữ liệu DB (mảng) hoặc Model sang DTO
     * @param array|Category $row - Dữ liệu từ database hoặc đối tượng Category
     * @return CategoryDTO
     */
    public static function toDTO($row) {
        if ($row instanceof Category) {
            // Chuyển từ Model sang DTO
            return new CategoryDTO(
                $row->getId(),
                $row->getName(),
                $row->getSlug(),
                $row->getDescription()
            );
        }

        // Chuyển từ mảng dữ liệu DB sang DTO
        $dto = new CategoryDTO();
        $dto->id = $row['id'] ?? null;
        $dto->name = $row['name'] ?? null;
        $dto->slug = $row['slug'] ?? null;
        $dto->description = $row['description'] ?? null;
        return $dto;
    }

    /**
     * Chuyển đổi từ dữ liệu DB (mảng) sang Model
     * @param array $row - Dữ liệu từ database
     * @return Category
     */
    public static function toModel($row) {
        return new Category($row);
    }
}
?>
