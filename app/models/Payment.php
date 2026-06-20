<?php
class Payment {
    public $id;
    public $order_id;
    public $method;     // COD | BANKING | MOMO | ZALOPAY
    public $amount;
    public $status;     // PENDING | COMPLETED | FAILED | REFUNDED
    public $transaction_id;
    public $created_at;
}
?>