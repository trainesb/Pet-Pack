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
                "amount" => 100,
                "currency" => "USD"
            ),
            "idempotency_key" => uniqid()
        );

        try {
            $this->result = $payments_api->createPayment($request_body);

        } catch (\SquareConnect\ApiException $e) {
            $this->result = json_encode(["ok" => false, "message" => $e]);
        }
    }

    public function getResult() { return $this->result; }
}