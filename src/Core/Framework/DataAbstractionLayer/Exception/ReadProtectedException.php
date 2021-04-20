<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Exception;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class ReadProtectedException extends ShopwareHttpException
{
    public function __construct(string $field, string $scope, ?\Throwable $previous = null)
    {
        parent::__construct(
            'The field/association "{{ field }}" is read protected for your scope "{{ scope }}"',
            [
                'field' => $field,
                'scope' => $scope,
            ],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__READ_PROTECTED';
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_FORBIDDEN;
    }
}
