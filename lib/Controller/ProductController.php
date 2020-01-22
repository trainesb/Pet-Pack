<?php


namespace Controller;


use Model\Site;
use Stripe\Exception\ApiErrorException;

class ProductController extends Controller {

    public function __construct(Site $site, $method) {
        parent::__construct($method);
    }

    protected function add() {
        try {
            $product = \Stripe\Product::create([
                'name' => $_POST['name'],
                'type' => 'good',
                'caption' => $_POST['caption'],
                'description' => $_POST['description']
            ]);
            return true;
        } catch (ApiErrorException $e) {
            return false;
        }
    }

    protected function delete() {

    }

    protected function update() {
    }

}