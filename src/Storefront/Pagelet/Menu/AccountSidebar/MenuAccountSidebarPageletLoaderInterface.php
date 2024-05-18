<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Menu\AccountSidebar;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\HttpFoundation\Request;

#[Package('storefront')]
interface MenuAccountSidebarPageletLoaderInterface
{
    public function load(Request $request, SalesChannelContext $context): MenuAccountSidebarPagelet;
}
