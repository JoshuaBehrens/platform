<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Plugin\Exception;

use Shopware\Core\Framework\ShopwareHttpException;

class PluginExtractionException extends ShopwareHttpException
{
    public function __construct(string $reason, ?\Throwable $previous = null)
    {
        parent::__construct(
            'Plugin extraction failed. Error: {{ error }}',
            ['error' => $reason],
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return 'FRAMEWORK__PLUGIN_EXTRACTION_FAILED';
    }
}
