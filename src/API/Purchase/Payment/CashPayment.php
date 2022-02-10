<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\API\Purchase\Payment;

use LauLamanApps\IzettleApi\API\Purchase\AbstractPayment;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

final class CashPayment extends AbstractPayment
{
    private $handedAmount;
    private $paymentType;

    public function __construct(UuidInterface $uuid, Money $amount, Money $handedAmount, string $paymentType)
    {
        parent::__construct($uuid, $amount);
        $this->handedAmount = $handedAmount;
        $this->paymentType = $paymentType;

    }

    public function getHandedAmount(): Money
    {
        return $this->handedAmount;
    }

    public function getChangeAmount(): Money
    {
        return $this->handedAmount->subtract($this->getAmount());
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }
}
