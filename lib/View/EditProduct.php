<?php


namespace View;


use Model\Site;
use Model\User;

class EditProduct extends View {

    private $catalogObject;
    private $productId;
    private $version;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isAdmin()) {
            header("location: ".$this->getProtectRedirect());
        }
        $this->setTitle("Edit Product");

        $this->productId = $_GET['id'];

        $catalogApi = new \SquareConnect\Api\CatalogApi($api_client);
        $this->catalogObject = $catalogApi->retrieveCatalogObject($this->productId);
        $this->version = $this->catalogObject->getObject()->getVersion();
    }

    public function present() {
        echo "<div class='adminNav'>";
        echo $this->adminNav();
        echo "</div>";

        echo "<div class='edit-product-wrapper'>";
        echo $this->tabs();
        echo $this->object();
        echo $this->itemData();
        echo $this->imageData();
        echo $this->variationData();
        echo $this->discountData();
        echo $this->itemOptionData();
        echo $this->itemOptionValue();
        echo $this->measurementUnit();
        echo $this->modifierData();
        echo "</div>";
    }


    public function measurementUnit() {
        $catalogObject = $this->catalogObject->getObject();
        $measurement = $catalogObject->getMeasurementUnitData();
        if($measurement) {
            $measurementUnit = $measurement->getMeasurementUnit();
            $precision = $measurement->getPrecision();
        } else {
            $measurementUnit = null;
            $precision = null;
        }
        return <<<HTML
<div class="measurement-unit-data" hidden>
    <p class="update-measurement-unit-data"><button>Update Measurement</button></p>
    <p class="measurement-unit" contenteditable="true">Measurement Unit: $measurementUnit</p>
    <p class="precision" contenteditable="true">Precision: $precision</p>
</div>
HTML;
    }

    public function modifierData() {
        $catalogObject = $this->catalogObject->getObject();
        $modifier = $catalogObject->getModifierListData();
        if($modifier) {
            $name = $modifier->getName();
            $modifiers = $modifier->getModifiers();
        } else {
            $name = null;
            $modifiers = null;
        }
        return <<<HTML
<div class="modifier-data" hidden>
    <p class="update-modifier-data"><button>Modifier Data</button></p>
    <p class="name" contenteditable="true">Name $name</p>
    <p class="modifiers" contenteditable="true">Modifiers: $modifiers</p>
</div>
HTML;
    }

    public function tabs() {
        return <<<HTML
<div class="tabs">
    <ul>
        <li class="active"><a class="object" href="">Object</a></li>
        <li><a class="image-data" href="">Image</a></li>
        <li><a class="item-data" href="">Item</a></li>
        <li><a class="item-variation-data" href="">Item Variation</a></li>
        <li><a class="discount-data" href="">Discount</a></li>
        <li><a class="item-option-data" href="">Item Option</a></li>
        <li><a class="option-value-data" href="">Option Value</a></li>
        <li><a class="measurement-unit-data" href="">Measurement Unit</a></li>
        <li><a class="modifier-data" href="">Modifier</a></li>
        <li><a class="pricing-rule-data" href="">Pricing Rule</a></li>
        <li><a class="product-set-data" href="">Product Set</a></li>
        <li><a class="tax-data" href="">Tax</a></li>
        <li><a class="time-period-data" href="">Time Period</a></li>
    </ul>
</div>
HTML;
    }

    public function object() {
        $catalogObject = $this->catalogObject->getObject();
        $type = $catalogObject->getType();
        $id = $catalogObject->getId();
        $updatedAt = $catalogObject->getUpdatedAt();
        $version = $catalogObject->getVersion();
        $isDeleted = $catalogObject->getIsDeleted();
        $image_id = $catalogObject->getImageId();
        return <<<HTML
<div class="object">
    <p class="type">Type: $type</p>
    <p class="id">Id: $id</p>
    <p class="updatedAt">Updated At: $updatedAt</p>
    <p class="version">Version: $version</p>
    <p class="isDeleted">Is Deleted: $isDeleted</p>
    <p class="imageId">Image Id: $image_id</p>
</div>
HTML;
    }

    public function imageData() {
        $catalogObject = $this->catalogObject->getObject();
        $imageData = $catalogObject->getImageData();
        if($imageData) {
            $caption = $imageData->getCaption();
            $name = $imageData->getName();
            $url = $imageData->getUrl();
        } else {
            $caption = null;
            $name = null;
            $url = null;
        }
            return <<<HTML
<div class="image-data" hidden>
    <form id="productImage" class="$this->productId" version="$this->version" method="post" enctype="multipart/form-data">
        <p>
            Select image to upload:
            <input type="file" name="product-image" id="product-image">
        </p>
        
        <p>
            <label for="caption">Caption: </label>
            <input type="text" name="caption" id="caption" placeholder="$caption">
        </p>
        
        <p>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" placeholder="$name">
        </p>
        
        <p>
            <label for="url">URL: </label>
            <input type="text" id="url" name="url" placeholder="$url">
        </p>
        
        <p><input type="submit" value="Save"></p>
    </form>
</div>
HTML;
    }

    public function itemData() {
        $catalogObject = $this->catalogObject->getObject();
        $itemData = $catalogObject->getItemData();
        $name = $itemData->getName();
        $description = $itemData->getDescription();
        $abbreviation = $itemData->getAbbreviation();

        return <<<HTML
<div class="item-data" hidden>
    <p class="update-item-data"><button>Update Item</button></p>
    <p class="name" contenteditable="true">Name: $name</p>
    <p class="description" contenteditable="true">Description: $description</p>
    <p class="abbreviation" contenteditable="true">Abbreviation: $abbreviation</p>
</div>
HTML;
    }

    public function variationData() {
        $catalogObject = $this->catalogObject->getObject();
        $variations = $catalogObject->getItemData()->getVariations();
        $html = "<div class='item-variation-data' hidden>";
        if(!empty($variations)) {
            foreach ($variations as $variation) {
                $type = $variation->getType();
                $id = $variation->getId();

                $variation_data = $variation->getItemVariationData();
                $item_id = $variation_data->getItemId();
                $name = $variation_data->getName();
                $sku = $variation_data->getSku();

                $priceMoney = $variation_data->getPriceMoney();
                $price = $priceMoney->getAmount();
                $currency = $priceMoney->getCurrency();

                $html .= <<<HTML
<div class="item-variation">
    <p class="update-variations"><button>Update Variations</button></p>
    <p class="type" contenteditable="true">Type: $type</p>
    <p class="id" contenteditable="true">Id: $id</p>
    <p class="itemId" contenteditable="true">Item Id: $item_id</p>
    <p class="name" contenteditable="true">Name: $name</p>
    <p class="sku" contenteditable="true">Sku: $sku</p>
    <p class="price" contenteditable="true">Price: $$price</p>
    <p class="currency" contenteditable="true">Currency: $currency</p>
</div>
HTML;
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function discountData() {
        $catalogObjects = $this->catalogObject->getObject();
        $discount = $catalogObjects->getDiscountData();
        if($discount) {
            $amountMoney = $discount->getAmountMoney();
            $amount = $amountMoney->getAmount();
            $currency = $amountMoney->getCurrency();

            $discountType = $discount->getDiscountType();
            $name = $discount->getName();
            $percentage = $discount->getPercentage();
            $pinRequired = $discount->getPinRequired();
        } else {
            $amount = null;
            $currency = null;
            $discountType = null;
            $name = null;
            $percentage = null;
            $pinRequired = null;
        }
        return <<<HTML
<div class="discount-data" hidden>
    <p class="update-discount-data"><button>Update Discount</button></p>
    <p class="amount" contenteditable="true">Amount: $$amount</p>
    <p class="currency" contenteditable="true">Currency: $currency</p>
    <p class="discount-type" contenteditable="true">Discount Type: $discountType</p>
    <p class="name" contenteditable="true">Name: $name</p>
    <p class="percentage" contenteditable="true">Percentage: $percentage</p>
    <p class="pin-required" contenteditable="true">PIN Required: $pinRequired</p>
</div>
HTML;
    }

    public function itemOptionData() {
        $catalogObject = $this->catalogObject->getObject();
        $itemOption = $catalogObject->getItemOptionData();
        if($itemOption) {
            $description = $itemOption->getDescription();
            $display_name = $itemOption->getDisplayName();
            $item_count = $itemOption->getItemCount();
            $name = $itemOption->getName();
        } else {
            $description = null;
            $display_name = null;
            $item_count = null;
            $name = null;
        }
        return <<<HTML
<div class="item-option-data" hidden>
    <p class="update-item-option"><button>Update Item Option</button></p>
    <p class="description" contenteditable="true">Description: $description</p>
    <p class="display-name" contenteditable="true">Display Name: $display_name</p>
    <p class="item-count" contenteditable="true">Item Count: $item_count</p>
    <p class="name" contenteditable="true">Name: $name</p>
</div>
HTML;
    }

    public function itemOptionValue() {
        $catalogObject = $this->catalogObject->getObject();
        $itemOption = $catalogObject->getItemOptionData();
        if($itemOption) {
            $optionValues = $itemOption->getValues();
            foreach ($optionValues as $option) {
                $option = $option->getItemOptionValueData();
                $description = $option->getDescription();
                $itemOptionId = $option->getItemOptionId();
                $name = $option->getName();
            }
        } else {
            $description = null;
            $itemOptionId = null;
            $name = null;
        }
        return <<<HTML
<div class="option-value-data" hidden>
    <p class="update-option-value"><button>Update Option Value</button></p>
    <p class="description" contenteditable="true">Description: $description</p>
    <p class="itemOptionId">Item Option Id: $itemOptionId</p>
    <p class="name" contenteditable="true">Name: $name</p>
</div>
HTML;
    }

    public function adminNav() {
        return <<<HTML
<nav id='adminNav'>
    <ul>
        <li><a href="./add-product.php">Add a Product</a></li>
        <li><a href="./members.php">Members</a></li>
        <li><a href="./products.php">Products</a></li>
    </ul>
</nav>
HTML;
    }

}