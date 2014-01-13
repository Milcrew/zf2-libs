<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Data\DataInterface;
use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\Json\JsonModel;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;

class StatusMessageDataModelFactory implements StatusMessageDataModelFactoryInterface
{
    /**
     * @return StatusMessageDataModelInterface
     */
    protected function getStatusMessagesDataModel()
    {
        return new JsonModel();
    }

    /**
     * @param string | MessagesInterface | array $messages [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getFailed($messages = null)
    {
        $statusMessagesDataModel = $this->getStatusMessagesDataModel();

        $statusMessagesDataModel->fail();

        if (!is_null($messages)) {
            $statusMessagesDataModel->setMessage($messages);
        }

        return $statusMessagesDataModel;
    }

    /**
     * @param DataInterface | array $data [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getSuccess($data = null)
    {
        $statusMessagesDataModel = $this->getStatusMessagesDataModel();

        if (!is_null($data)) {
            $statusMessagesDataModel->setData($data);
        }

        return $statusMessagesDataModel->success();
    }
}
