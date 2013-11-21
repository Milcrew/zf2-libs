<?php
namespace Zf2Libs\View\Model\FailedJson;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\FailedJsonModel;

class FailedMessagesModel extends FailedJsonModel
{
    public function __construct(MessagesInterface $messages)
    {
        $this->setVariable('messages', $messages->getMessages());
        parent::__construct();
    }
}
