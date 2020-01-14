<?php


namespace API;


class PaymentCardTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "payment-card");
    }
}