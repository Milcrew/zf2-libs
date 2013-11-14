<?php
namespace Zf2Libs\Data;

use Zend\InputFilter\InputFilter;

class AbstractInputFilter extends InputFilter implements DataInterface
{
    /**
     * @var bool
     */
    private $isValid = null;

    public function isValid()
    {
        if (!is_null($this->isValid)) {
            return $this->isValid;
        }

        return ($this->isValid = parent::isValid());
    }

    /**
     * @param array|\Traversable $data
     * @return bool|null|\Zend\InputFilter\InputFilterInterface
     */
    public function setData($data)
    {
        $this->isValid = null;
        return parent::setData($data);
    }
}
