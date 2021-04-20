<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Store\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Shopware\Core\Framework\Store\Struct\ReviewStruct;
use Symfony\Component\HttpFoundation\Response;

class InvalidExtensionRatingValueException extends ShopwareHttpException
{
    public function __construct(int $rating, array $parameters = [], ?\Throwable $previous = null)
    {
        $parameters['rating'] = $rating;
        $parameters['maxRating'] = ReviewStruct::MAX_RATING;
        $parameters['minRating'] = ReviewStruct::MIN_RATING;

        parent::__construct('Invalid rating value {{rating}}. The value must correspond to a number in the interval from {{minRating}} to {{maxRating}}.', $parameters, $previous);
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__INVALID_EXTENSION_RATING_VALUE';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
