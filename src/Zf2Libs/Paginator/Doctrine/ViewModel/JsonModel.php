<?php
namespace Zf2Libs\Paginator\Doctrine\ViewModel;

use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel as ZendJsonModel;
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
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        foreach ($paginator->getCurrentItems() as $k=>$item) {
            $this->setVariable($k, $this->extractor->extract($item));
        }
    }
}
