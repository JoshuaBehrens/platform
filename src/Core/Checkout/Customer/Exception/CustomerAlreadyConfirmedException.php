<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Customer\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class CustomerAlreadyConfirmedException extends ShopwareHttpException
{
    public function __construct(string $id, ?\Throwable $previous = null)
    {
        parent::__construct(
            'The customer with the id "{{ customerId }}" is already confirmed.',
            ['customerId' => $id],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'CHECKOUT__CUSTOMER_IS_ALREADY_CONFIRMED';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_PRECONDITION_FAILED;
    }
}
