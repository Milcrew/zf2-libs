<?php
namespace Zf2Libs\Paginator\DojoRestStore;

use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Paginator\AdapterAggregateInterface;
use Zend\Paginator\Paginator as PaginatorPaginator;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;

class Paginator extends PaginatorPaginator
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
     * @param AdapterInterface | AdapterAggregateInterface $adapter
     * @param Request $request
     * @param Response $response
     */
    public function __construct($adapter, Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $hydrator = new RangeHydrator();
        $data = $hydrator->extract($this->request->getHeaders());

        parent::__construct($adapter);

        $this->setItemCountPerPage($data['count']);
        $offset = ($data['offset'] < 1 ? 1 : $data['offset']);
        $page = $this->normalizePageNumber(($offset / $this->getItemCountPerPage())+1);

        $this->setCurrentPageNumber($page);

        $hydrator->hydrate(array('totalCount'=>$this->getTotalItemCount(),
                                 'page'=>$this->getCurrentPageNumber(),
                                 'itemsOnPage'=>$this->getItemCountPerPage()),
                           $response->getHeaders());
    }
}
