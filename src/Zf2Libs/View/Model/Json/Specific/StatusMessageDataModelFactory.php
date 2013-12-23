<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\Json\JsonModel;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;

class StatusMessageDataModelFactory implements StatusMessageDataModelFactoryInterface
{
    /**
     * @return StatusMessageDataModelInterface
     */
    protected function getStatusMessagesModel()
    {
        return new JsonModel();
    }

    /**
     * @param string | MessagesInterface | array $messages [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getFailed($messages = null)
    {
        $statusMessagesModel = $this->getStatusMessagesModel();

        $statusMessagesModel->fail();

        if (!is_null($messages)) {
            $statusMessagesModel->setMessage($messages);
        }

        return $statusMessagesModel;
    }

    /**
     * @return StatusMessageDataModelInterface
     */
    public function getSuccess()
    {
        $statusMessagesModel = $this->getStatusMessagesModel();
        return $statusMessagesModel->success();
    }
}
