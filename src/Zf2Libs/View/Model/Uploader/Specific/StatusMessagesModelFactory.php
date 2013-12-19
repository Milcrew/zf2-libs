<?php
namespace Zf2Libs\View\Model\Uploader\Specific;

use Zf2Libs\View\Model\Json\Specific\StatusMessagesModelFactory as BaseStatusMessagesModelFactory;
use Zf2Libs\View\Model\StatusMessagesModelInterface;
use Zf2Libs\View\Model\Uploader\Specific\UploaderModel;

class StatusMessagesModelFactory extends BaseStatusMessagesModelFactory
{
    /**
     * @return StatusMessagesModelInterface
     */
    protected function getStatusMessagesModel()
    {
        return new UploaderModel();
    }
}
