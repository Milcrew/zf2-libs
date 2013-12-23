<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;

interface StatusMessageDataModelFactoryInterface
{
    /**
     * @param MessagesInterface | array $messages
     * @return StatusMessageDataModelInterface
     */
    public function getFailed($messages = null);

    /**
     * @return StatusMessageDataModelInterface
     */
    public function getSuccess();
}
