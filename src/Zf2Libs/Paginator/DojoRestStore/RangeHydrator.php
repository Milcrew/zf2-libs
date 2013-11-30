<?php
namespace Zf2Libs\Paginator\DojoRestStore;

use Zend\Http\Header\ContentRange;
use Zend\Http\Headers;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zf2Libs\Paginator\DojoRestStore\Exception\InvalidArgumentException;

class RangeHydrator implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Headers) {
            throw new InvalidArgumentException("Invalid object, Headers object expected");
        }

        if (!($rangeHeader = $object->get('Range')) &&
            !($rangeHeader = $object->get('X-Range'))) {
            return array('offset'=>0, 'count'=>1);
        }

        if (!preg_match("/^items=(?P<from>[0-9]+)-(?P<to>[0-9]+)$/", $rangeHeader->getFieldValue(), $matches)) {
            return array('offset' => 0, 'count' => 1);
        }

        $count = 0;
        if ($matches['from'] < $matches['to']) {
            $count = intval($matches['to'] - $matches['from'])+1;
        }

        return array('offset'=>$matches['from'], 'count'=>$count);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Headers) {
            throw new InvalidArgumentException("Invalid object, Headers object expected");
        }

        if (count(array_diff(array('from', 'to'), array_keys($data)))) {
            throw new InvalidArgumentException("Invalid data array, must have at least from and to keys.");
        }

        $count = 0;
        if (array_key_exists('totalCount', $data)) {
            $count = $data['totalCount'];
        }

        $string = "Content-Range: items {$data['from']}-{$data['to']}/{$count}";
        $rangeHeader = ContentRange::fromString($string);
        $object->addHeader($rangeHeader);

        return $object;
    }

}
