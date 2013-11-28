<?php
namespace Zf2Libs\Paginator\Doctrine;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapterPaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class QueryPaginator extends DoctrineAdapterPaginator
{
    /**
     * @param Query | QueryBuilder $query
     */
    public function __construct($query)
    {
        parent::__construct(new DoctrinePaginator($query));
    }
}
