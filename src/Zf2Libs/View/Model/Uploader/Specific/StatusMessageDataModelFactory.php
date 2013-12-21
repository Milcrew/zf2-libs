<?php
namespace Zf2Libs\View\Model\Uploader\Specific;

use Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactory as BaseStatusMessageDataModelFactory;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;
use Zf2Libs\View\Model\Uploader\Specific\UploaderModel;

class StatusMessageDataModelFactory extends BaseStatusMessageDataModelFactory
{
    /**
     * @return StatusMessageDataModelInterface
     */
    protected function getStatusMessagesModel()
    {
        return new UploaderModel();
    }
}
