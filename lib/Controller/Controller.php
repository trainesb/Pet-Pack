<?php


namespace Controller;


class Controller {

    const ADD = 'A';
    const DELETE = 'D';
    const UPDATE = 'U';

    private $result;

    public function __construct($method) {
        switch ($method) {
            case self::ADD:
                if ($this->add())
                    $this->result = json_encode(['ok' => true]);
                else
                    $this->result = json_encode(['ok' => false, 'message' => 'Error creating new user']);
                break;
            case self::DELETE:
                $this->delete();
                break;
            case self::UPDATE:
                if ($this->update())
                    $this->result = json_encode(['ok' => true]);
                else
                    $this->result = json_encode(['ok' => false, 'message' => 'Error updating user']);
                break;
            default:
                $this->result = json_encode(['ok' => false, 'message' => 'Error unknown method']);
        }
    }

    public function getResult() { return $this->result; }

}