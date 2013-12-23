<?php
namespace Zf2Libs\Paginator\ViewModel;

use Zend\View\Model\JsonModel as ZendJsonModel;
use Zf2Libs\Paginator\PaginationInterface;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;

class JsonModel extends ZendJsonModel
{
    /**
     * @var ExtractorInterface
     */
    protected $extractor = null;

    /**
     * @param ExtractorInterface $extractor
     */
    public function __construct(ExtractorInterface $extractor)
    {
       $this->extractor = $extractor;
    }

    /**
     * @param PaginationInterface $paginator
     */
    public function setPaginator(PaginationInterface $paginator)
    {
        foreach ($paginator->getCurrentItems() as $k=>$item) {
            $this->setVariable($k, $this->extractor->extract($item));
        }
    }
}
