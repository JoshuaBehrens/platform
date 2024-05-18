<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Menu\AccountSidebar;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Script\Execution\Awareness\SalesChannelContextAwareTrait;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\PageLoadedHook;

/**
 * Triggered when the MenuAccountSidebarPagelet is loaded
 *
 * @hook-use-case data_loading
 *
 * @since 6.6.3.0
 *
 * @final
 */
#[Package('storefront')]
class MenuAccountSidebarPageletLoadedHook extends PageLoadedHook
{
    use SalesChannelContextAwareTrait;

    final public const HOOK_NAME = 'menu-account-sidebar-pagelet-loaded';

    public function __construct(
        private readonly MenuAccountSidebarPagelet $page,
        SalesChannelContext $context
    ) {
        parent::__construct($context->getContext());
        $this->salesChannelContext = $context;
    }

    public function getName(): string
    {
        return self::HOOK_NAME;
    }

    public function getPage(): MenuAccountSidebarPagelet
    {
        return $this->page;
    }
}
