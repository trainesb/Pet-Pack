<?php


namespace Model;


class Email {

    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
}