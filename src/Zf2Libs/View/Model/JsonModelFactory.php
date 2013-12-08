<?php
namespace Zf2Libs\View\Model;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\FailedJson\FailedMessagesModel;

class JsonModelFactory
{
    /**
     * @param MessagesInterface $messages
     * @return FailedMessagesModel | FailedJsonModel
     */
    public function getFailed(MessagesInterface $messages = null)
    {
        if (!is_null($messages)) {
            return new FailedMessagesModel($messages);
        } else {
            return new FailedJsonModel();
        }
    }

    /**
     * @return SuccessJsonModel
     */
    public function getSuccess()
    {
        return new SuccessJsonModel();
    }
}
