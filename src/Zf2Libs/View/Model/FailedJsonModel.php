<?php
namespace Zf2Libs\View\Model;

use Zend\View\Model\JsonModel;

class FailedJsonModel extends JsonModel
{
    public function __construct()
    {
        $this->setVariable('status', 0);
    }
}