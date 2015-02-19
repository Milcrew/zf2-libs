<?php
namespace Zf2Libs\View\Model\Json\Specific;

use Zf2Libs\Stdlib\Messages\MessagesInterface;
use Zf2Libs\View\Model\DataInterface;
use Zf2Libs\View\Model\StatusMessageDataModelInterface;

interface StatusMessageDataModelFactoryInterface
{
    /**
     * @param string | MessagesInterface | DataInterface | array $response [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getFailed($response = null);

    /**
     * @param string | MessagesInterface | DataInterface | array $response [OPTIONAL]
     * @return StatusMessageDataModelInterface
     */
    public function getSuccess($response = null);
}
