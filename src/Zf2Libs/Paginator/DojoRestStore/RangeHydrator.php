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

        if (!$rangeHeader = $object->get('Range')) {
            return array('offset'=>1, 'count'=>1);
        }

        if (!preg_match("/^items=(?P<from>[0-9]+)-(?P<to>[0-9]+)$/", $rangeHeader->getFieldValue(), $matches)) {
            return array('offset' => 1, 'count' => 1);
        }

        $count = 0;
        if ($matches['from'] < $matches['to']) {
            $count = intval($matches['to'] - $matches['from']) + 1;
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

        $count = 0;
        if (array_key_exists('totalCount', $data)) {
            $count = $data['totalCount'];
        }

        $from = $to = 0;
        if (array_key_exists('itemsOnPage', $data) && array_key_exists('page', $data)) {
            $from = intval($data['page'] * $data['itemsOnPage']);
            $to = intval(($data['page'] + 1) * $data['itemsOnPage']);
            if ($to > $count) {
                $to = $count;
            }
        }

        $string = "Content-Range: items {$from}-{$to}/{$count}";
        $rangeHeader = ContentRange::fromString($string);
        $object->addHeader($rangeHeader);

        return $object;
    }

}
