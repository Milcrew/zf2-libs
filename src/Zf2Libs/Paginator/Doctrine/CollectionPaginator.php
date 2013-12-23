<?php
namespace Zf2Libs\Paginator\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;
use Zend\Paginator\Adapter\AdapterInterface;

class CollectionPaginator implements AdapterInterface
{
    /**
     * @var ArrayCollection
     */
    protected $collection;

    public function __construct(ArrayCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Returns an collection of items for a page.
     *
     * @param  int $offset Page offset
     * @param  int $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
        return $this->collection->slice($offset, $itemCountPerPage);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return $this->collection->count();
    }
}
