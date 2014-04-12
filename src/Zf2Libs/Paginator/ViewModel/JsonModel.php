<?php
namespace Zf2Libs\Paginator\ViewModel;

use Zend\View\Model\JsonModel as ZendJsonModel;
use Zf2Libs\Paginator\PaginationInterface;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Paginator\Exception\InvalidArgumentException;

class JsonModel extends ZendJsonModel implements JsonModelInterface
{
    /**
     * @var ExtractorInterface
     */
    protected $extractor = null;

    /**
     * @param ExtractorInterface $extractor [OPTIONAL]
     */
    public function __construct(ExtractorInterface $extractor = null)
    {
       $this->extractor = $extractor;
    }

    /**
     * @param PaginationInterface $paginator
     * @throws InvalidArgumentException
     */
    public function setPaginator(PaginationInterface $paginator)
    {
        foreach ($paginator->getCurrentItems() as $k=>$item) {
            if (!is_array($item) && is_null($this->extractor)) {
                throw new InvalidArgumentException('Extractor must be defined for the \Zf2Libs\Paginator\ViewModel\JsonModel');
            }

            $this->setVariable($k, !is_null($this->extractor) ?
                                   $this->extractor->extract($item) :
                                   $item);
        }
    }
}
