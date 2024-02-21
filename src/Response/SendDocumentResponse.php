<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

class SendDocumentResponse extends AbstractResponse implements ResponseInterface
{
    public function getId(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public function getType(): ?string
    {
        return $this->data['type'] ?? null;
    }

    public function getState(): ?string
    {
        return $this->data['state'] ?? null;
    }

    public function getSupplierGLN(): ?string
    {
        return $this->data['supplierGLN'] ?? null;
    }

    public function getBuyerGLN(): ?string
    {
        return $this->data['buyerGLN'] ?? null;
    }
}
