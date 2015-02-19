<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Response\DataInterface;
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
     * @param string | MessagesInterface | DataInterface | array $response [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getFailed($response = null)
    {
        $statusMessagesDataModel = $this->getStatusMessagesDataModel();
        $statusMessagesDataModel->fail();

        if (!is_null($response) && (is_array($response) ||
                                    is_string($response) ||
                                    $response instanceof MessagesInterface) ) {
            $statusMessagesDataModel->setMessage( $response );
        }

        if (!is_null($response) && $response instanceof DataInterface ) {
            $statusMessagesDataModel->setData( $response );
        }

        return $statusMessagesDataModel;
    }

    /**
     * @param StatusMessageDataModelInterface $statusMessagesDataModel
     * @param $response
     */
    protected function processResponse(StatusMessageDataModelInterface $statusMessagesDataModel, $response)
    {
        if (!is_null($response) && (is_array($response) ||
                                    is_string($response) ||
                                    $response instanceof MessagesInterface) ) {
            $statusMessagesDataModel->setMessage( $response );
        }

        if (!is_null($response) && $response instanceof DataInterface ) {
            $statusMessagesDataModel->setData( $response );
        }
    }

    /**
     * @param string | MessagesInterface | DataInterface | array $response [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getSuccess($response = null)
    {
        $statusMessagesDataModel = $this->getStatusMessagesDataModel();
        $statusMessagesDataModel->success();
        if (!is_null($response) && (is_array($response) ||
                                    is_string($response) ||
                                    ($response instanceof MessagesInterface &&
                                     count($response->getMessages()))) ) {
            $statusMessagesDataModel->setMessage( $response );
        }

        if (!is_null($response) && $response instanceof DataInterface ) {
            $statusMessagesDataModel->setData( $response );
        }
        return $statusMessagesDataModel;
    }
}
