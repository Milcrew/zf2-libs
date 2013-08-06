<?php
namespace Zf2Libs\Mvc\Router\Http;

use Traversable;
use Zend\Http\Headers;
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
        if (!method_exists($request, 'getHeaders')) {
            return null;
        }

        /* @var $headers Headers */
        $headers = $request->getHeaders();

        if (!($header = $headers->get('X-Requested-With'))) {
            return null;
        }

        if ($this->with == $header->getFieldValue()) {
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
