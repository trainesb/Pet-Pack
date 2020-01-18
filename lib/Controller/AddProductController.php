<?php


namespace Controller;


class AddProductController {

    private $result;

    public function __construct($site, $user, $api_client) {
        var_dump($_POST);

        $catalogApi = new \SquareConnect\Api\CatalogApi($api_client);

        $itemId = "#itemId";
        $itemData = new \SquareConnect\Model\CatalogItem();

        $itemData->setName("Item Name");
        $itemData->setDescription("Item Description");
        $itemData->setAbbreviation("It");

        $item = new \SquareConnect\Model\CatalogObject();
        $item->setType("ITEM");
        $item->setId($itemId);
        $item->setItemData($itemData);

        $upsert = new \SquareConnect\Model\UpsertCatalogObjectRequest();
        $upsert->setIdempotencyKey(uniqid());
        $upsert->setObject($item);

        try {
            $result = $catalogApi->upsertCatalogObject($upsert);
            print_r($result);
            $this->result = json_encode(["ok" => true]);
        } catch (\Exception $e) {
            echo 'Exception when calling CatalogApi->upsertCatalogObject: ', $e->getMessage(), PHP_EOL;
            $this->result = json_encode(["ok" => false, "message" => $e->getMessage()]);
        }
    }

    public function getResult() { return $this->result; }

}