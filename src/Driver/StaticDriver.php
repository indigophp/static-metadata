<?php

namespace Indigo\Metadata\Driver;

use Metadata\Driver\AdvancedDriverInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class StaticDriver implements AdvancedDriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function loadMetadataForClass(\ReflectionClass $class)
    {
        if (!$class->implementsInterface('Indigo\Metadata\HasMetadata')) {
            return null;
        }

        $className = $class->getName();

        return $className::getMetadata();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllClassNames()
    {
        return array_filter(
            get_declared_classes(),
            function ($className) {
                return in_array('Indigo\Metadata\HasMetadata', class_implements($className));
            }
        );
    }
}
