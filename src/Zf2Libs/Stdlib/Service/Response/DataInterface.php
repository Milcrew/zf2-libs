<?php
namespace Zf2Libs\Service\Response;

use Zf2Libs\Stdlib\Response\DataInterface as DataDataInterface;

interface DataInterface extends DataDataInterface
{
    /**
     * @return array
     */
    public function getData();
}
