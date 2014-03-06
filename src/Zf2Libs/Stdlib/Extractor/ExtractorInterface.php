<?php
namespace Zf2Libs\Stdlib\Extractor;

interface ExtractorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object);
}
