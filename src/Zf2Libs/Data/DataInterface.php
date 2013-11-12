<?php
namespace Zf2Libs\Data;

interface DataInterface
{
    /**
     * @param  array | \Traversable $data
     * @return DataInterface
     */
    public function setData($data);

    /**
     * @return boolean
     */
    public function isValid();
}
