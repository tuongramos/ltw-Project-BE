<?php
class OrderDetailMapper {
    public static function toDTO($model) {
        $dto = new OrderDetailDTO();
        $dto->id            = $model->id;
        $dto->order_id      = $model->order_id;
        $dto->product_id    = $model->product_id;
        $dto->product_name  = $model->product_name;
        $dto->product_image = $model->product_image;
        $dto->quantity      = $model->quantity;
        $dto->unit_price    = $model->unit_price;
        $dto->subtotal      = $model->subtotal;
        return $dto;
    }

    public static function toDTOList($models) {
        return array_map([self::class, 'toDTO'], $models);
    }
}
?>