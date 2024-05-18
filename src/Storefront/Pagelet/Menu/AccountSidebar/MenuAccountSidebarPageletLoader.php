<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Menu\AccountSidebar;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Do not use direct or indirect repository calls in a PageletLoader. Always use a store-api route to get or put data.
 */
#[Package('storefront')]
class MenuAccountSidebarPageletLoader implements MenuAccountSidebarPageletLoaderInterface
{
    /**
     * @internal
     */
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function load(Request $request, SalesChannelContext $context): MenuAccountSidebarPagelet
    {
        $isHeaderWidget = (string) $request->query->get('headerWidget', false);

        $pagelet = new MenuAccountSidebarPagelet();
        $pagelet->setShowGreeting(!$isHeaderWidget);

        $this->eventDispatcher->dispatch(
            new MenuAccountSidebarPageletLoadedEvent($pagelet, $context, $request)
        );

        return $pagelet;
    }
}
