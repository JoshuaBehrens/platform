<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Routing;

use Shopware\Core\SalesChannelRequest;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalRedirectService
{
    /**
     * @var SystemConfigService
     */
    private $configService;

    public function __construct(SystemConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * getRedirect takes a request processed by the RequestTransformer and checks,
     * wether it points to a SEO-URL which has been superseded. In case the corresponding
     * configuration option is active, it returns a redirect response to indicate, that
     * the request should be redirected to the canonical URL.
     */
    public function getRedirect(Request $request): ?Response
    {
        // This attribute has been set by the RequestTransformer if the requested URL was superseded.
        $canonical = $request->attributes->get(SalesChannelRequest::ATTRIBUTE_CANONICAL_LINK);
        $shouldRedirect = $this->configService->get('core.seo.redirectToCanonicalUrl');

        if (!$shouldRedirect) {
            return null;
        }

        if (empty($canonical)) {
            return null;
        }

        return new RedirectResponse($canonical, Response::HTTP_MOVED_PERMANENTLY);
    }
}