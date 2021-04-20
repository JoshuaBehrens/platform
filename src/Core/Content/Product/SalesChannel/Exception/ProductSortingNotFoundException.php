<?php declare(strict_types=1);

namespace Shopware\Core\Content\Product\SalesChannel\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class ProductSortingNotFoundException extends ShopwareHttpException
{
    public function __construct(string $key, ?\Throwable $previous = null)
    {
        parent::__construct(
            'Product sorting with key {{ key }} not found.',
            ['key' => $key],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'CONTENT__PRODUCT_SORTING_NOT_FOUND';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
