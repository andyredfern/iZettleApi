<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\API\Purchase\Payment;

use DateTime;
use LauLamanApps\IzettleApi\API\Purchase\AbstractPayment;
use LauLamanApps\IzettleApi\Client\Purchase\Exception\PaymentTypeNotConfiguredException;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

final class InvoicePayment extends AbstractPayment
{
    private $orderUuid;
    private $invoiceNr;
    private $dueDate;
    private $paymentType;

    public function __construct(
        UuidInterface $uuid,
        Money $amount,
        UuidInterface $orderUuid,
        string $invoiceNr,
        DateTime $dueDate,
        String $PaymentType
    ) {
        parent::__construct($uuid, $amount, $PaymentType);

        $this->orderUuid = $orderUuid;
        $this->invoiceNr = $invoiceNr;
        $this->dueDate = $dueDate;
        $this->paymentType = $PaymentType;
    }

    public function getOrderUuid(): UuidInterface
    {
        return $this->orderUuid;
    }

    public function getInvoiceNr(): string
    {
        return $this->invoiceNr;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }
}
