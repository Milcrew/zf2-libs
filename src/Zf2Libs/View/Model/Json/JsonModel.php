<?php
namespace Zf2Libs\View\Model\Json;

use Zend\View\Model\JsonModel as ZendJsonModel;
use Zf2Libs\Stdlib\Data\DataInterface;
use Zf2Libs\Stdlib\Messages\MessagesInterface as StdlibMessagesInterface;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;

class JsonModel extends ZendJsonModel implements StatusMessageDataModelInterface
{
    /**
     * @param array | string | StdlibMessagesInterface $messages
     * @return $this
     */
    public function setMessage($message)
    {
        if (is_array($message)) {
            $this->setVariable('message', $message);
        } else if ($message instanceof StdlibMessagesInterface) {
            $this->setVariable('message', $message->getMessages());
        } else {
            $this->setVariable('message', (string)$message);
        }

        return $this;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->setVariable('status', (int)$status ? 1 : 0);
        return $this;
    }

    /**
     * @param string | DataInterface | array $data
     * @return $this
     */
    public function setData($data)
    {
        if ($data instanceof DataInterface) {
            $data = $data->getData();
        } else if (!is_array($data)) {
            $data = array($data);
        }

        $this->setVariable('data', $data);
        return $this;
    }

    /**
     * @return $this
     */
    public function success()
    {
        $this->setVariable('status', 1);
        return $this;
    }

    /**
     * @return $this
     */
    public function fail()
    {
        $this->setVariable('status', 0);
        return $this;
    }
}
