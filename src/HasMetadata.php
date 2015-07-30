<?php

namespace Indigo\Metadata;

use Metadata\ClassMetadata;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface HasMetadata
{
    /**
     * @return ClassMetadata
     */
    public static function getMetadata();
}
