<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Migration;

use Shopware\Core\Framework\Bundle;
use Shopware\Core\Framework\Plugin\KernelPluginLoader\KernelPluginLoader;
use Shopware\Core\Kernel;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MigrationSourceFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var KernelPluginLoader
     */
    private $kernelPluginLoader;

    public function __construct(ContainerInterface $container, KernelPluginLoader $kernelPluginLoader)
    {
        $this->container = $container;
        $this->kernelPluginLoader = $kernelPluginLoader;
    }

    public function create(Bundle $bundle): MigrationSource
    {
        $result = new MigrationSource($bundle->getName());
        /** @var Kernel $kernel */
        $kernel = $this->container->get('kernel');

        $bundles = $this->kernelPluginLoader->getBundleBundles($bundle, $kernel->getParameters());
        $bundles[] = $bundle;

        foreach ($bundles as $bundleItem) {
            $relativeNamespace = str_replace($bundleItem->getNamespace(), '', $bundleItem->getMigrationNamespace());
            $directory = str_replace('\\', '/', $bundleItem->getPath() . $relativeNamespace);

            if (!@is_dir($directory)) {
                continue;
            }

            $result->addDirectory($directory, $bundleItem->getMigrationNamespace());
        }

        return $result;
    }
}
