<?php
namespace Zf2Libs\View\Model\FailedJson;

use Zf2Libs\View\Model\FailedJsonModel;
use Zf2Libs\View\Model\MessagesInterface;

class FailedMessagesModel extends FailedJsonModel
{
    public function __construct(MessagesInterface $messages)
    {
        $this->setVariable('messages', $messages->getMessages());
        parent::__construct();
    }
}
