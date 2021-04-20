<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Order\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class GuestNotAuthenticatedException extends ShopwareHttpException
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Guest not authenticated.', [], $previous);
    }

    public function getErrorCode(): string
    {
        return 'CHECKOUT__GUEST_NOT_AUTHENTICATED';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_FORBIDDEN;
    }
}
