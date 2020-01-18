<?php


namespace View;


use API\OrderTable;
use Model\Site;
use Model\User;

class OrdersView extends View {

    private $payments = [];

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        $orderTable = new OrderTable($site);
        $orders = $orderTable->getByUser($user->getId());
        $payments = new \SquareConnect\Api\PaymentsApi($api_client);

        if(!empty($orders)) {
            foreach ($orders as $order) {
                $payment = $payments->getPayment($order['paymentId']);
                array_push($this->payments, $payment->getPayment());
            }
        }
    }

    public function present() {
        echo $this->nav();
        echo $this->payments();
        echo $this->footer();
    }

    public function payments() {
        $html = '<div class="payment-wrapper">';
        if(!empty($this->payments)) {
            foreach ($this->payments as $payment) {
                $ordered_at = $payment->getCreatedAt();
                $price = $payment->getAmountMoney()->getAmount();
                $html .= <<<HTML
<div class="payment">
    <p>Ordered AT: $ordered_at</p>
    <p>$$price</p>
</div>
HTML;
            }
        } else {
            $html .= '<p>No Orders.</p>';
        }
        $html .= '</div>';
        return $html;
    }
}