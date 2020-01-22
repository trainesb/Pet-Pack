<?php


namespace View;


use Model\Site;
use Model\User;
use Stripe\Exception\ApiErrorException;

class Products extends View {

    public function __construct(Site $site, User $user = null) {
        parent::__construct($site, $user);
        $this->setTitle('Products');
    }

    public function present() {
        echo $this->products();
    }

    public function products() {
        try {
            $products = \Stripe\Product::all();
            return '<pre>'.var_export($products, true).'</pre>';
        } catch (ApiErrorException $e) {
            return '<p>Error: '.$e.'</p>';
        }
    }
}