<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Exception;

use Shopware\Core\Framework\ShopwareHttpException;

class ApiProtectionException extends ShopwareHttpException
{
    public function __construct(string $accessor, ?\Throwable $previous = null)
    {
        parent::__construct(
            'Accessor {{ accessor }} is not allowed in this api scope',
            ['accessor' => $accessor],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__ACCESSOR_NOT_ALLOWED';
    }
}
