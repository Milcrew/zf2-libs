<?php
namespace Zf2Libs\Paginator\DojoRestStore;

use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;

class Paginator implements PaginationInterface
{
    /**
     * @var Request
     */
    protected $request = null;

    /**
     * @var Response
     */
    protected $response = null;

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
     * @param Request $request
     * @param Response $response
     */
    public function __construct(AdapterInterface $adapter, Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $hydrator = new RangeHydrator();
        $data = $hydrator->extract($this->request->getHeaders());

        $this->offset = $data['offset'];
        $this->count = $data['count'];
        $this->adapter = $adapter;

        $hydrator->hydrate(array('totalCount'=>count($adapter),
                                 'from'=>$this->offset,
                                 'to'=>$this->offset+$this->count),
                           $response->getHeaders());
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
