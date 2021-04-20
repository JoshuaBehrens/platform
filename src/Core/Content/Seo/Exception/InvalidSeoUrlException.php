<?php declare(strict_types=1);

namespace Shopware\Core\Content\Seo\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class InvalidSeoUrlException extends ShopwareHttpException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__INVALID_SEO_URL';
    }
}
