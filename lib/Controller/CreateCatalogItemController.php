<?php


namespace Controller;


class CreateCatalogItemController {

    private $result;

    public function __construct($site, $api_client) {
        $catalogApi = new \SquareConnect\Api\CatalogApi($api_client);
        $itemData = new \SquareConnect\Model\CatalogItem();

        $itemData->setName($_POST["name"]);
        $itemData->setDescription($_POST["description"]);

        // Create a new catalog object of the ITEM type
        $catalogItem = new \SquareConnect\Model\CatalogObject();
        $catalogItem->setType("ITEM");
        $catalogItem->setId('#petpack');

        /* Default Variation
        $defaultVariation = new \SquareConnect\Model\CatalogItemVariation();

        $defaultVariation->setName("Default");
        $defaultVariation->setItemId("#default");

        // Create a Money object to represent the price of the item variation
        $price = new \SquareConnect\Model\Money();
        $price->setAmount(10000);       // => $100.00
        $price->setCurrency("USD");

        $defaultVariation->setPriceMoney($price);
        $defaultVariation->setPricingType("FIXED_PRICING");

        $default = new \SquareConnect\Model\CatalogObject();
        $default->setType("ITEM_VARIATION");
        $default->setItemVariationData($defaultVariation);

        $itemData->setVariations(array($default));
        */
        $catalogItem->setItemData($itemData);

        // Create the request object for UpsertCatalogObject
        $body = new \SquareConnect\Model\UpsertCatalogObjectRequest();
        $body->setIdempotencyKey(uniqid());
        $body->setObject($catalogItem);

        // Make the call
        try {
            $result = $catalogApi->upsertCatalogObject($body);
            echo 'Success!';
            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling CatalogApi->upsertCatalogObject: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function getResult() { return $this->result; }
}