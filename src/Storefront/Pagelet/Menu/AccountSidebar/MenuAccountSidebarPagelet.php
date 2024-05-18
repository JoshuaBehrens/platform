<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Menu\AccountSidebar;

use Shopware\Core\Framework\Log\Package;
use Shopware\Storefront\Pagelet\Pagelet;

#[Package('storefront')]
class MenuAccountSidebarPagelet extends Pagelet
{
    protected bool $showGreeting = false;

    public function getShowGreeting(): bool
    {
        return $this->showGreeting;
    }

    public function setShowGreeting(bool $showGreeting): void
    {
        $this->showGreeting = $showGreeting;
    }
}
