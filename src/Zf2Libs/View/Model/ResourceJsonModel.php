<?php
namespace Zf2Libs\View\Model;

use Zend\View\Model\JsonModel;

class ResourceJsonModel extends JsonModel
{
    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->setVariables($data);
    }
}
