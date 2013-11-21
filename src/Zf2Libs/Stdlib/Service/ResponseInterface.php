<?php
namespace Zf2Libs\Stdlib\Service;

interface ResponseInterface
{
    /**
     * @return mixed
     */
    public function isSuccess();

    /**
     * @return mixed
     */
    public function isFailed();

    /**
     * @return ResponseInterface
     */
    public function failed();

    /**
     * @return ResponseInterface
     */
    public function success();
}
