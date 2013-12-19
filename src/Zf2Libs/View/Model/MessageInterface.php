<?php
namespace Zf2Libs\View\Model;

use Zf2Libs\Stdlib\Messages\MessagesInterface;

interface MessageInterface
{
    /**
     * @param string | array | MessagesInterface $message
     * @return $this
     */
    public function setMessage($message);
}
