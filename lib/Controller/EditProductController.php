<?php


namespace Controller;


class EditProductController {

    private $result;

    public function __construct($site, $user, $api_client) {
        highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>");
        highlight_string("<?php\n\$_FILES =\n" . var_export($_FILES, true) . ";\n?>");


        if($_POST['type'] === 'IMAGE') {
            $url = $this->uploadImage($_FILES);
            if($url) {
                $this->addProductImage($url, $_POST['version'], $_POST['name'], $_POST['caption'], $_POST['productId'], $api_client);
            }
        }
    }

    public function addProductImage($url, $version, $name, $caption, $productId, $api_client) {
        $catalogObject = new \SquareConnect\Model\CatalogObject();

        $catalogImage = new \SquareConnect\Model\CatalogImage();

        $catalogImage->setName($name);
        $catalogImage->setUrl($url);
        $catalogImage->setCaption($caption);

        $catalogObject->setImageData($catalogImage);
        $catalogObject->setType('IMAGE');
        $catalogObject->setVersion((int)$version);
        $catalogObject->setId("#temp");

        $objectRequest = new \SquareConnect\Model\UpsertCatalogObjectRequest();
        $objectRequest->setObject($catalogObject);
        $objectRequest->setIdempotencyKey(uniqid());

        $catalogAPI = new \SquareConnect\Api\CatalogApi($api_client);

        try {
            $result = $catalogAPI->upsertCatalogObject($objectRequest);
            echo '<pre>' . var_export($result, true) . '</pre>';
        } catch (\Exception $e) {
            echo 'Exception when calling CustomersApi->updateCustomer: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function uploadImage($file) {
        $target_dir  = dirname(__FILE__)."../../../dist/img/";
        $target_file = $target_dir . basename($file['productImage']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image is real or fake
        $check = getimagesize($file['productImage']['tmp_name']);
        if(!$check) {
            $this->result = json_encode(["ok" => false, "message" => "File isn't an image!"]);
            return false;
        }

        // Check if file exists
        if(file_exists($target_file)) {
            $this->result = json_encode(["ok" => false, "message" => "File already exists"]);
            return false;
        }

        // Limit file size
        if($file['productImage']['size'] > 10000000) {
            $this->result = json_encode(["ok" => false, "message" => "File is to large"]);
            return false;
        }

        // Limit file type
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            $this->result = json_encode(["ok" => false, "message" => "Only JPG, JPEG, PNG, & GIF files allowed!"]);
            return false;
        }

        // Upload image
        if(!move_uploaded_file($file['productImage']['tmp_name'], $target_file)) {
            $this->result = json_encode(["ok" => false, "message" => "Error, uploading file"]);
            return false;
        }

        $this->result = json_encode(["ok" => true]);
        return $target_file;
    }

    public function getResult() { return $this->result; }
}