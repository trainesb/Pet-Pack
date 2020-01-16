<?php


namespace Controller;


use API\OrderTable;

class CheckoutController {

    private $result;

    public function __construct($site) {
        $dotenv = \Dotenv\Dotenv::create(__DIR__.'\..\..');
        $dotenv->load();

        $access_token = ($_ENV["USE_PROD"] == 'true')  ?  $_ENV["PROD_ACCESS_TOKEN"] : $_ENV["SANDBOX_ACCESS_TOKEN"];
        $host_url = ($_ENV["USE_PROD"] == 'true')  ?  "https://connect.squareup.com" : "https://connect.squareupsandbox.com";
        $api_config = new \SquareConnect\Configuration();
        $api_config->setHost($host_url);
        $api_config->setAccessToken($access_token);
        $api_client = new \SquareConnect\ApiClient($api_config);

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
            //echo "Caught exception!<br/>";
            //print_r("<strong>Response body:</strong><br/>");
            //echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            //echo "<br/><strong>Response headers:</strong><br/>";
            //echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
        }
    }

    public function getResult() { return $this->result; }
}