<?php
class OrderMapper {
    public static function toDTO($model) {
        $dto = new OrderDTO();
        $dto->id              = $model->id;
        $dto->order_code      = $model->order_code;
        $dto->customer_name   = $model->customer_name;
        $dto->customer_phone  = $model->customer_phone;
        $dto->customer_email  = $model->customer_email;
        $dto->shipping_address = $model->shipping_address;
        $dto->status          = $model->status;
        $dto->total_amount    = $model->total_amount;
        $dto->discount_amount = $model->discount_amount;
        $dto->final_amount    = $model->final_amount;
        $dto->promotion_code  = $model->promotion_code;
        $dto->note            = $model->note;
        $dto->created_at      = $model->created_at;
        return $dto;
    }

    public static function toDTOList($models) {
        return array_map([self::class, 'toDTO'], $models);
    }
}
?>