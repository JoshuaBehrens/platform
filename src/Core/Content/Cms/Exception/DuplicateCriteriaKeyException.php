<?php declare(strict_types=1);

namespace Shopware\Core\Content\Cms\Exception;

use Shopware\Core\Framework\ShopwareHttpException;

class DuplicateCriteriaKeyException extends ShopwareHttpException
{
    public function __construct(string $key, ?\Throwable $previous = null)
    {
        parent::__construct(
            'The key "{{ key }}" is duplicated in the criteria collection.',
            ['key' => $key],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'CONTENT__DUPLICATE_CRITERIA_KEY';
    }
}
