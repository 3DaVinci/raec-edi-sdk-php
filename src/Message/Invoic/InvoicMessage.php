<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Invoic;

use DateTimeImmutable;
use RaecEdiSDK\Message\AbstractMessage;
use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Message\MessagePopulateTrait;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use JsonSerializable;
use RaecEdiSDK\Utils;

class InvoicMessage extends AbstractMessage implements MessageInterface, JsonSerializable
{
    use ObjectSerializeTrait;
    use MessagePopulateTrait;

    protected string $updNumber;

    protected DateTimeImmutable $updDate;

    protected string $sfNumber;

    protected DateTimeImmutable $sfDate;

    protected string $invoiceNumber;

    protected DateTimeImmutable $invoiceDate;

    protected ?string $ttnNumber = null;

    protected ?DateTimeImmutable $ttnDate = null;

    protected string $shipTo;

    protected string $shipFrom;

    protected ?string $shipFromStorageName = null;

    protected DateTimeImmutable $supplierEstimatedDeliveryDate;

    protected string $supplierInn;

    protected string $supplierKpp;

    protected ?string $shipperInn = null;

    protected ?string $shipperKpp = null;

    protected string $buyerInn;

    protected string $buyerKpp;

    protected ?string $consigneeInn = null;

    protected ?string $consigneeKpp = null;

    protected string $currencyIsoCode;

    protected ?string $transportCompanyInn = null;

    protected ?string $trackingNumber = null;

    protected ?DateTimeImmutable $dateOfPayment = null;

    protected ?bool $paidByFactoring = null;

    protected ?string $supplierProjectNumber = null;

    protected ?string $supplierContactManager = null;

    protected ?string $supplierContactManagerEmail = null;

    protected ?string $supplierContactManagerPhone = null;

    public function __construct(
        string $supplierGLN,
        string $buyerGLN,
        string $updNumber,
        DateTimeImmutable $updDate,
        string $sfNumber,
        DateTimeImmutable $sfDate,
        string $invoiceNumber,
        DateTimeImmutable $invoiceDate,
        string $shipTo,
        string $shipFrom,
        DateTimeImmutable $supplierEstimatedDeliveryDate,
        string $supplierInn,
        string $supplierKpp,
        string $buyerInn,
        string $buyerKpp,
        string $currencyIsoCode,
        bool $isTest = self::DEFAULT_IS_TEST_VALUE
    )
    {
        $this->updNumber = $updNumber;
        $this->updDate = $updDate;
        $this->sfNumber = $sfNumber;
        $this->sfDate = $sfDate;
        $this->invoiceNumber = $invoiceNumber;
        $this->invoiceDate = $invoiceDate;
        $this->shipTo = $shipTo;
        $this->shipFrom = $shipFrom;
        $this->supplierEstimatedDeliveryDate = $supplierEstimatedDeliveryDate;
        $this->supplierInn = $supplierInn;
        $this->supplierKpp = $supplierKpp;
        $this->buyerInn = $buyerInn;
        $this->buyerKpp = $buyerKpp;
        $this->currencyIsoCode = $currencyIsoCode;

        parent::__construct(self::TYPE_INVOIC, $supplierGLN, $buyerGLN, $isTest);
    }

    public function setDateOfPayment(?DateTimeImmutable $dateOfPayment): InvoicMessage
    {
        $this->dateOfPayment = $dateOfPayment;
        return $this;
    }


    public function setTtnNumber(?string $ttnNumber): InvoicMessage
    {
        $this->ttnNumber = $ttnNumber;
        return $this;
    }

    public function setTtnDate(?DateTimeImmutable $ttnDate): InvoicMessage
    {
        $this->ttnDate = $ttnDate;
        return $this;
    }

    public function setShipFromStorageName(?string $shipFromStorageName): InvoicMessage
    {
        $this->shipFromStorageName = $shipFromStorageName;
        return $this;
    }

    public function setShipperInn(?string $shipperInn): InvoicMessage
    {
        $this->shipperInn = $shipperInn;
        return $this;
    }

    public function setShipperKpp(?string $shipperKpp): InvoicMessage
    {
        $this->shipperKpp = $shipperKpp;
        return $this;
    }

    public function setConsigneeInn(?string $consigneeInn): InvoicMessage
    {
        $this->consigneeInn = $consigneeInn;
        return $this;
    }

    public function setConsigneeKpp(?string $consigneeKpp): InvoicMessage
    {
        $this->consigneeKpp = $consigneeKpp;
        return $this;
    }

    public function setTransportCompanyInn(?string $transportCompanyInn): InvoicMessage
    {
        $this->transportCompanyInn = $transportCompanyInn;
        return $this;
    }

    public function setTrackingNumber(?string $trackingNumber): InvoicMessage
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    public function setPaidByFactoring(?bool $paidByFactoring): InvoicMessage
    {
        $this->paidByFactoring = $paidByFactoring;
        return $this;
    }

    public function setSupplierProjectNumber(?string $supplierProjectNumber): InvoicMessage
    {
        $this->supplierProjectNumber = $supplierProjectNumber;
        return $this;
    }

    public function setSupplierContactManager(?string $supplierContactManager): InvoicMessage
    {
        $this->supplierContactManager = $supplierContactManager;
        return $this;
    }

    public function setSupplierContactManagerEmail(?string $supplierContactManagerEmail): InvoicMessage
    {
        $this->supplierContactManagerEmail = $supplierContactManagerEmail;
        return $this;
    }

    public function setSupplierContactManagerPhone(?string $supplierContactManagerPhone): InvoicMessage
    {
        $this->supplierContactManagerPhone = $supplierContactManagerPhone;
        return $this;
    }

    public function getUpdNumber(): string
    {
        return $this->updNumber;
    }

    public function getUpdDate(): DateTimeImmutable
    {
        return $this->updDate;
    }

    public function getSfNumber(): string
    {
        return $this->sfNumber;
    }

    public function getSfDate(): DateTimeImmutable
    {
        return $this->sfDate;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function getInvoiceDate(): DateTimeImmutable
    {
        return $this->invoiceDate;
    }

    public function getTtnNumber(): ?string
    {
        return $this->ttnNumber;
    }

    public function getTtnDate(): ?DateTimeImmutable
    {
        return $this->ttnDate;
    }

    public function getShipTo(): string
    {
        return $this->shipTo;
    }

    public function getShipFrom(): string
    {
        return $this->shipFrom;
    }

    public function getShipFromStorageName(): ?string
    {
        return $this->shipFromStorageName;
    }

    public function getSupplierEstimatedDeliveryDate(): DateTimeImmutable
    {
        return $this->supplierEstimatedDeliveryDate;
    }

    public function getSupplierInn(): string
    {
        return $this->supplierInn;
    }

    public function getSupplierKpp(): string
    {
        return $this->supplierKpp;
    }

    public function getShipperInn(): ?string
    {
        return $this->shipperInn;
    }

    public function getShipperKpp(): ?string
    {
        return $this->shipperKpp;
    }

    public function getBuyerInn(): string
    {
        return $this->buyerInn;
    }

    public function getBuyerKpp(): string
    {
        return $this->buyerKpp;
    }

    public function getConsigneeInn(): ?string
    {
        return $this->consigneeInn;
    }

    public function getConsigneeKpp(): ?string
    {
        return $this->consigneeKpp;
    }

    public function getCurrencyIsoCode(): string
    {
        return $this->currencyIsoCode;
    }

    public function getTransportCompanyInn(): ?string
    {
        return $this->transportCompanyInn;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function getDateOfPayment(): ?DateTimeImmutable
    {
        return $this->dateOfPayment;
    }

    public function getPaidByFactoring(): ?bool
    {
        return $this->paidByFactoring;
    }

    public function getSupplierProjectNumber(): ?string
    {
        return $this->supplierProjectNumber;
    }

    public function getSupplierContactManager(): ?string
    {
        return $this->supplierContactManager;
    }

    public function getSupplierContactManagerEmail(): ?string
    {
        return $this->supplierContactManagerEmail;
    }

    public function getSupplierContactManagerPhone(): ?string
    {
        return $this->supplierContactManagerPhone;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'ttnNumber',
            'shipFromStorageName',
            'shipperInn',
            'shipperKpp',
            'consigneeInn',
            'consigneeKpp',
            'transportCompanyInn',
            'trackingNumber',
            'supplierProjectNumber',
            'supplierContactManager',
            'supplierContactManagerEmail',
            'supplierContactManagerPhone',
        ];
        $this->setStringProperties($stringProperties, $data);

        $this->setBooleanProperties(['paidByFactoring'], $data);

        $dateProperties = ['ttnDate', 'dateOfPayment'];
        foreach ($dateProperties as $property) {
            if (isset($data[$property]) && $data[$property]) {
                $this->$property = Utils::stringToDate((string) $data[$property], $property);
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();
        $properties = [
            'updDate',
            'sfDate',
            'invoiceDate',
            'supplierEstimatedDeliveryDate',
            'dateOfPayment'
        ];
        foreach ($properties as $propertyName) {
            if ($this->$propertyName) {
                $data[$propertyName] = Utils::dateToString($this->$propertyName);
            }
        }

        $data['items'] = $this->getSerializedItems();

        return $data;
    }
}
