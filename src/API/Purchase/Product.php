<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\API\Purchase;

use LauLamanApps\IzettleApi\API\Image;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Product
{
    private $productUuid; //" => "3b3565e0-2694-11e7-b983-c70f05a416cd"
    private $variantUuid; //" => "c2a45f90-269e-11e7-9657-51506d0a8492"
    private $name; //" => "Munten"
    private $variantName; //" => "20 munten"
    private $quantity; //" => "1"
    private $unitPrice; //" => 1000
    private $vatPercentage; //" => 0.0
    private $rowTaxableAmount; //" => 1000
    private $imageLookupKey; //" => ""
    private $autoGenerated; //" => false
    private $libraryProduct;

    public function __construct(
        ?UuidInterface $productUuid = null,
        ?UuidInterface $variantUuid = null,
        ?string $type = null,
        ?string $name = null,
        ?string $variantName = null,
        int $quantity,
        Money $unitPrice,
        float $vatPercentage,
        Money $rowTaxableAmount,
        ?Image $imageLookupKey = null,
        bool $autoGenerated,
        bool $libraryProduct,
        ?string $sku = null,
        ?string $barcode = null,
        ?string $comment = null
    ) {
        $this->productUuid = $productUuid;
        $this->variantUuid = $variantUuid;
        $this->type = $type;
        $this->name = $name;
        $this->variantName = $variantName;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->vatPercentage = $vatPercentage;
        $this->rowTaxableAmount = $rowTaxableAmount;
        $this->imageLookupKey = $imageLookupKey;
        $this->autoGenerated = $autoGenerated;
        $this->libraryProduct = $libraryProduct;
        $this->sku = $sku;
        $this->barcode = $barcode;
        $this->comment = $comment;
    }

    public function getProductUuid()
    {
        return $this->productUuid;
    }

    public function getVariantUuid()
    {
        return $this->variantUuid;
    }

    public function getType()
    {
        return $this->name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVariantName()
    {
        return $this->variantName;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function getVatPercentage(): float
    {
        return $this->vatPercentage;
    }

    public function getRowTaxableAmount(): Money
    {
        return $this->rowTaxableAmount;
    }

    public function getImageLookupKey()
    {
        return $this->imageLookupKey;
    }

    public function isAutoGenerated(): bool
    {
        return $this->autoGenerated;
    }

    public function isLibraryProduct(): bool
    {
        return $this->libraryProduct;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    public function getComment()
    {
        return $this->barcode;
    }
}
