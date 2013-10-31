<?php
namespace Zf2Libs\Filter;

use Zend\Filter\AbstractFilter;

class Formatter extends AbstractFilter
{
	/**
	 * String which contains place-holders to
	 * replace with bindings
	 *
	 * @var string
	 */
	protected $template = "";

	/**
	 * Holders format
	 *
	 * @var string
	 */
	protected $configTemplate = "%%%d";

	/**
	 * Constructor of filter
	 */
	public function __construct($template)
	{
		$this->template = $template;
	}

    /**
     * Replace placeholder one by one
     *
     * @param string $template hystack
     * @param string $value replacement
     * @param int $position placeholder position
     * @return string
     */
    protected function replace($template, $value, $position=1)
    {
    	$arrayToString = new ArrayToString();
    	$needle = sprintf($this->configTemplate,(int)$position);
    	if (strpos($template,$needle) !== false) {
    		if (is_array($value)) {
    			$string = $arrayToString->filter($value);
    		} else if ($value instanceof \Exception) {
    		    $obj = new \ReflectionObject($value);
    		    $string = "Exception Object: ".$obj->getName();
    		    $string.= "\n Message: ".$value->getMessage();
    		    $string.= "\n Trace: ".$value->getTraceAsString();
    		} else if (is_object($value)) {
    		    $obj = new \ReflectionObject($value);
    		    $string = "Object with name : ".$obj->getName();
    		} else {
    			$string = (string)$value;
    		}
    		return str_replace($needle,$string,$template);
    	}

    	return $template;
    }

    /**
     * Perform place holders replacement as filter
     *
     * @param string $template
     * @param mixed $bindings
     * @return string
     */
    public function filter($bindings)
    {
    	if (!is_array($bindings)) {
    		return $this->replace($this->template,$bindings);
    	}

    	$position = 0;
    	$template = $this->template;
    	foreach ($bindings as $bind) {
    		$template = $this->replace($template,$bind,++$position);
    	}
        return $template;
    }

}