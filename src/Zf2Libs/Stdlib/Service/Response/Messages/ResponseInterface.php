<?php
namespace Zf2Libs\Stdlib\Service\Response\Messages;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\Stdlib\Service\AbstractResponse;

interface ResponseInterface extends MessagesInterface
{
    /**
     * @param string $message
     * @return $this
     */
    public function error($message);

    /**
     * @return AbstractResponse
     */
    public function success();
}
