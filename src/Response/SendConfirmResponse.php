<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

class SendConfirmResponse extends AbstractResponse implements ResponseInterface
{
    public function isConfirmed(): bool
    {
        return $this->data['status'] === 'confirmed';
    }
}
