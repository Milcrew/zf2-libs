<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zf2Libs\Mvc\Router\Http;

use Traversable;
use Zend\Mvc\Router\Exception;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\RequestInterface as Request;

/**
 * XRequestedWith route.
 */
class XRequestedWith implements RouteInterface
{
    /**
     * Requested with string match.
     *
     * @var string
     */
    protected $with;

    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Create a new method route.
     *
     * @param  string $with
     * @param  array  $defaults
     */
    public function __construct($with, array $defaults = array())
    {
        $this->with     = $with;
        $this->defaults = $defaults;
    }

    /**
     * factory(): defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::factory()
     * @param  array|Traversable $options
     * @return XRequestedWith
     * @throws Exception\InvalidArgumentException
     */
    public static function factory($options = array())
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new Exception\InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
        }

        if (!isset($options['with'])) {
            throw new Exception\InvalidArgumentException('Missing "with" in options array');
        }

        if (!isset($options['defaults'])) {
            $options['defaults'] = array();
        }

        return new static($options['with'], $options['defaults']);
    }

    /**
     * match(): defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::match()
     * @param  Request $request
     * @return RouteMatch | null
     */
    public function match(Request $request)
    {
        \Zf2Libs\Debug\Utility::dump("REQUEST", $request);

        if (!method_exists($request, 'getMethod')) {
            return null;
        }

        $requestVerb = strtoupper($request->getMethod());
        $matchVerbs  = explode(',', strtoupper($this->verb));
        $matchVerbs  = array_map('trim', $matchVerbs);

        if (in_array($requestVerb, $matchVerbs)) {
            return new RouteMatch($this->defaults);
        }

        return null;
    }

    /**
     * assemble(): Defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::assemble()
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = array(), array $options = array())
    {
        // The request method does not contribute to the path, thus nothing is returned.
        return '';
    }

    /**
     * getAssembledParams(): defined by RouteInterface interface.
     *
     * @see    RouteInterface::getAssembledParams
     * @return array
     */
    public function getAssembledParams()
    {
        return array();
    }
}
