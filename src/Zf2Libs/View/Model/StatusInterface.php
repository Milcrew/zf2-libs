<?php
namespace Zf2Libs\View\Model;

interface StatusInterface
{
    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return $this
     */
    public function success();

    /**
     * @return $this
     */
    public function fail();
}
