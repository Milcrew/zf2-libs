<?php
namespace Zf2Libs\Filter;

use Zend\Filter\AbstractFilter;
use Zend\Filter\StripNewlines;

class ArrayToString extends AbstractFilter
{
    /**
     * @param array $array
     * @return string
     */
    public function filter($array)
    {
        if (!is_array($array)) {
            return $array;
        }

    	$filter = new StripNewlines();
        return preg_replace('/\(\s/','(',preg_replace('/\s{2,}/',' ',$filter->filter(print_r($array,true))));
    }
}