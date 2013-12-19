<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Messages\MessagesInterface;

interface StatusMessagesModelFactoryInterface
{
    /**
     * @param MessagesInterface | array $messages
     * @return $this
     */
    public function getFailed($messages = null);

    /**
     * @return $this
     */
    public function getSuccess();
}
