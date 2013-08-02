<?php
namespace Zf2Libs\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Json\Encoder;

class DataDojoProps extends AbstractHelper
{
    /**
     * @return array
     */
    public function __invoke(array $props)
    {
        array_walk($props, function (&$item, $key) {
            if (is_array($item) || is_object($item)) {
                $item = \Zend\Json\Encoder::encode($item);
            } else {
                $item = addcslashes($item, "'\"");
                $item = sprintf('%s', trim(\Zend\Json\Encoder::encode($item), '{}'));
            }

            $item = sprintf('"%s": %s', $key, $item);
        });
        return join(",\n",$props);
    }
}
