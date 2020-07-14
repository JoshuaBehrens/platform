<?php declare(strict_types=1);

namespace Shopware\Core\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1594767164UpdateProductCoverForeignKey extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1594767164;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            ALTER TABLE `product` DROP FOREIGN KEY `fk.product.product_media_id`
        ');

        $connection->executeUpdate('
            ALTER TABLE `product`
                ADD CONSTRAINT `fk.product.product_media_id`
                    FOREIGN KEY (`product_media_id`, `product_media_version_id`) REFERENCES `product_media` (`id`, `version_id`)
                        ON UPDATE CASCADE ON DELETE SET NULL
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}

