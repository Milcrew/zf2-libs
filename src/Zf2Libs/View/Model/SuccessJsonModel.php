<?php
namespace Zf2Libs\View\Model;

use Zend\View\Model\JsonModel;

class SuccessJsonModel extends JsonModel
{
    public function __construct()
    {
        $this->setVariable('status', 1);
    }
}