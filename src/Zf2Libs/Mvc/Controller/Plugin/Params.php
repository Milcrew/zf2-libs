<?php
namespace Zf2Libs\Mvc\Controller\Plugin;


class Params extends \Zend\Mvc\Controller\Plugin\Params
{
    /**
     * Return all put parameters or a single put parameter.
     *
     * @param string $param Parameter name to retrieve, or null to get all.
     * @param mixed $default Default value to use when the parameter is missing.
     * @return mixed
     */
    public function fromPut($param = null, $default = null)
    {
        $content = $this->getController()->getRequest()->getContent();

        parse_str($content, $parsedParams);

        // If parse_str fails to decode, or we have a single element with key
        // 0, return the raw content.
        if (!is_array($parsedParams)
            || (1 == count($parsedParams) && isset($parsedParams[0]))
        ) {
            return $default;
        }

        if ($param === null) {
            return $parsedParams;
        }

        if (!array_key_exists($param, $parsedParams)) {
           return $default;
        }

        return $parsedParams[$param];
    }
}
