<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Menu\AccountSidebar;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Pagelet\PageletLoadedEvent;
use Symfony\Component\HttpFoundation\Request;

#[Package('storefront')]
class MenuAccountSidebarPageletLoadedEvent extends PageletLoadedEvent
{
    public function __construct(
        protected readonly MenuAccountSidebarPagelet $pagelet,
        SalesChannelContext $salesChannelContext,
        Request $request
    ) {
        parent::__construct($salesChannelContext, $request);
    }

    public function getPagelet(): MenuAccountSidebarPagelet
    {
        return $this->pagelet;
    }
}
