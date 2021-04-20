<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Store\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class InvalidExtensionIdException extends ShopwareHttpException
{
    public function __construct(array $parameters = [], ?\Throwable $previous = null)
    {
        parent::__construct('The extension id must be an non empty numeric value.', $parameters, $previous);
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__INVALID_EXTENSION_ID';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
