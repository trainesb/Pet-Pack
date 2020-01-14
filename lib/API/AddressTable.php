<?php


namespace API;


class AddressTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "address");
    }
}