<?php
namespace Zf2Libs\Paginator;

interface PaginationInterface
{
    /**
     * Returns the items for the current offset.
     *
     * @return \Traversable
     */
    public function getCurrentItems();
}
