<?php
namespace Zf2Libs\Stdlib\Hydrator;

use Zf2Libs\Stdlib\Hydrator\Exception\InvalidArgumentException;

interface HydratorInterface
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @throws InvalidArgumentException
     * @return object
     */
    public function hydrate(array $data, $object);
}
