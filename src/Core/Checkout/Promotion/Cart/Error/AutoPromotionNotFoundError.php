<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Promotion\Cart\Error;

use Shopware\Core\Checkout\Cart\Error\Error;

class AutoPromotionNotFoundError extends Error
{
    private const KEY = 'auto-promotion-not-found';

    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name, ?\Throwable $previous = null)
    {
        $this->name = $name;

        $this->message = sprintf('Promotion %s was no longer valid!', $this->name);

        parent::__construct($this->message, 0, $previous);
    }

    public function getParameters(): array
    {
        return ['name' => $this->name];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return sprintf('%s-%s', self::KEY, $this->name);
    }

    public function getMessageKey(): string
    {
        return self::KEY;
    }

    public function getLevel(): int
    {
        return self::LEVEL_ERROR;
    }

    public function blockOrder(): bool
    {
        return true;
    }
}
