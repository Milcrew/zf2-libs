<?php
namespace Zf2Libs\Stdlib\Service;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var bool
     */
    protected $result = false;

    /**
     * @return AbstractResponse
     */
    public function failed()
    {
        $this->result = false;
        return $this;
    }

    /**
     * @return AbstractResponse
     */
    public function success()
    {
        $this->result = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->result === true;
    }

    /**
     * @return bool
     */
    public function isFailed()
    {
        return $this->result === false;
    }
}
