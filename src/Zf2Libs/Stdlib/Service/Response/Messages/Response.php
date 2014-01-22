<?php
namespace Zf2Libs\Stdlib\Service\Response\Messages;

use Zf2Libs\Stdlib\Service\AbstractResponse;

class Response extends AbstractResponse implements ResponseMessagesInterface
{
    protected $messages = array();

    /**
     * @param string $message
     * @return $this
     */
    public function error($message)
    {
        array_push($this->messages, $message);
        return $this;
    }

    /**
     * @return AbstractResponse
     */
    public function success()
    {
        $this->messages = array();
        return parent::success();
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
