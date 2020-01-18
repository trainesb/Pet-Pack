<?php


namespace Controller;


use API\OrderTable;

class CheckoutController {

    private $result;

    public function __construct($site, $api_client, $user) {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            error_log("Received a non-POST request");
            echo "Request not allowed";
            http_response_code(405);
            return;
        }

        $nonce = $_POST['nonce'];
        if (is_null($nonce)) {
            echo "Invalid card data";
            http_response_code(422);
            return;
        }

        $payments_api = new \SquareConnect\Api\PaymentsApi($api_client);

        $request_body = array (
            "source_id" => $nonce,
            "amount_money" => array (
                "amount" => 10000,
                "currency" => "USD"
            ),
            "shipping_address" => array(
                "address_line_1" => $_POST['address1'],
                "address_line_2" => $_POST['address2'],
                "administrative_district_level_1" => $_POST['state'],
                "administrative_district_level_1" => $_POST['city'],
                "country" => 'US',
                "first_name" => $_POST['firstName'],
                "last_name" => $_POST['lastName'],
                "postal_code" => $_POST['zip']
            ),
            "idempotency_key" => uniqid()
        );

        try {
            $result = $payments_api->createPayment($request_body);
            $paymentId = $result->getPayment()->getId();
            $userId = $user->getId();
            $orders = new OrderTable($site);
            $orders->addOrder($userId, $paymentId);
        } catch (\SquareConnect\ApiException $e) {
            $this->result = json_encode(["ok" => false, "message" => $e]);
        }
    }

    public function getResult() { return $this->result; }
}