<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Field;

use Shopware\Core\Framework\DataAbstractionLayer\DefinitionInstanceRegistry;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldSerializer\ReferenceVersionFieldSerializer;
use Shopware\Core\Framework\DataAbstractionLayer\Version\VersionDefinition;

class ReferenceVersionField extends FkField
{
    /**
     * @var string
     */
    protected $versionReferenceClass;

    /**
     * @var EntityDefinition
     */
    protected $versionReferenceDefinition;

    /**
     * @var string|null
     */
    protected $compoundIdStorageName;

    /**
     * @var string|null
     */
    protected $compoundIdPropertyName;

    public function __construct(string $definition, ?string $storageName = null, ?string $compoundIdStorageName = null)
    {
        parent::__construct('', '', VersionDefinition::class);

        $this->versionReferenceClass = $definition;
        $this->storageName = $storageName;
        $this->compoundIdStorageName = $compoundIdStorageName;
    }

    public function compile(DefinitionInstanceRegistry $registry): void
    {
        if ($this->versionReferenceDefinition !== null) {
            return;
        }

        parent::compile($registry);

        $this->versionReferenceDefinition = $registry->get($this->versionReferenceClass);
        $entity = $this->versionReferenceDefinition->getEntityName();
        $storageName = $this->storageName ?? $entity . '_version_id';
        $compoundIdStorageName = $this->compoundIdStorageName ?? $entity . '_id';

        if (!is_null($this->storageName) && is_null($this->compoundIdStorageName)) {
            $storageNamePos = strpos($this->storageName, '_version_id');

            if ($storageNamePos === (strlen($this->storageName) - strlen('_version_id'))) {
                $compoundIdStorageName = substr($this->storageName, 0, $storageNamePos) . '_id';
            }
        }

        $propertyName = $this->convertStorageToPropertyName($storageName);
        $compoundIdPropertyName = $this->convertStorageToPropertyName($compoundIdStorageName);

        $this->storageName = $storageName;
        $this->compoundIdStorageName = $compoundIdStorageName;
        $this->propertyName = $propertyName;
        $this->compoundIdPropertyName = $compoundIdPropertyName;
    }

    public function getStorageName(): string
    {
        return $this->storageName;
    }

    public function getCompoundIdStorageName(): ?string
    {
        return $this->compoundIdStorageName;
    }

    public function getCompoundIdPropertyName(): ?string
    {
        return $this->compoundIdPropertyName;
    }

    public function getVersionReferenceDefinition(): EntityDefinition
    {
        return $this->versionReferenceDefinition;
    }

    public function getVersionReferenceClass(): string
    {
        return $this->versionReferenceClass;
    }

    protected function getSerializerClass(): string
    {
        return ReferenceVersionFieldSerializer::class;
    }

    private function convertStorageToPropertyName(string $storageName): string
    {
        $propertyName = explode('_', $storageName);
        $propertyName = array_map('ucfirst', $propertyName);

        return lcfirst(implode($propertyName));
    }
}
