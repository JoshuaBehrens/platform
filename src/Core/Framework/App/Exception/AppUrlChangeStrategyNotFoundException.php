<?php declare(strict_types=1);

namespace Shopware\Core\Framework\App\Exception;

/**
 * @internal only for use by the app-system, will be considered internal from v6.4.0 onward
 */
class AppUrlChangeStrategyNotFoundException extends \RuntimeException
{
    public function __construct(string $strategyName, ?\Throwable $previous = null)
    {
        parent::__construct('Unable to find AppUrlChangeResolver with name: "' . $strategyName . '".', 0, $previous);
    }
}
