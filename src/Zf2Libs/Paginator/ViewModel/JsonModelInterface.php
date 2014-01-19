<?php
namespace Zf2Libs\Paginator\ViewModel;

use Zf2Libs\Paginator\PaginationInterface;

interface JsonModelInterface
{
    /**
     * @param PaginationInterface $paginator
     */
    public function setPaginator(PaginationInterface $paginator);
}
