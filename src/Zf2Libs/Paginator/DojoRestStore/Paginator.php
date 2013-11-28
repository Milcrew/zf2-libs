<?php
namespace Zf2Libs\Paginator\DojoRestStore;

use Zend\Http\Headers;
use Zend\Paginator\Adapter\AdapterInterface;
use Zf2Libs\Paginator\PaginationInterface;

class Paginator implements PaginationInterface
{
    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @var array | null
     */
    protected $currentItems = null;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface
     * @param Headers $requestHeaders
     * @param Headers $responseHeaders
     */
    public function __construct(AdapterInterface $adapter, Headers $requestHeaders, Headers $responseHeaders)
    {
        $hydrator = new RangeHydrator();
        $data = $hydrator->extract($requestHeaders);

        $this->offset = $data['offset'];
        $this->count = $data['count'];
        $this->adapter = $adapter;

        $responseHeaders = new Headers();

        $hydrator->hydrate(array('totalCount'=>count($adapter),
                                 'from'=>$this->offset,
                                 'to'=>$this->offset+$this->count),
                           $responseHeaders);
    }

    /**
     * Returns the items for the current page.
     *
     * @return \Traversable
     */
    public function getCurrentItems()
    {
        if ($this->currentItems === null) {
            $this->currentItems = $this->getItems();
        }

        return $this->currentItems;
    }

    /**
     * Returns the items for a given page.
     *
     * @param int $pageNumber
     * @return mixed
     */
    protected function getItems()
    {
        $items = $this->adapter->getItems($this->offset, $this->count);

        if (!$items instanceof \Traversable) {
            $items = new \ArrayIterator($items);
        }

        return $items;
    }
}
