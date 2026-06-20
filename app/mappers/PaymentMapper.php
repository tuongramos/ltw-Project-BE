<?php
class PaymentMapper {
    public static function toDTO($model) {
        $dto = new PaymentDTO();
        $dto->id             = $model->id;
        $dto->order_id       = $model->order_id;
        $dto->method         = $model->method;
        $dto->amount         = $model->amount;
        $dto->status         = $model->status;
        $dto->transaction_id = $model->transaction_id;
        $dto->created_at     = $model->created_at;
        return $dto;
    }

    public static function toDTOList($models) {
        return array_map([self::class, 'toDTO'], $models);
    }
}
?>
