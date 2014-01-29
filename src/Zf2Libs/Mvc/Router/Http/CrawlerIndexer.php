<?php
namespace Zf2Libs\Mvc\Router\Http;

use Traversable;
use Zend\Mvc\Router\Exception;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Parameters;
use Zend\Stdlib\RequestInterface as Request;

/**
 * CrawlerIndexer route.
 */
class CrawlerIndexer implements RouteInterface
{
    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Query param, crawler will use it according to
     * this documentations:
     *
     * @link https://developers.google.com/webmasters/ajax-crawling/docs/getting-started?hl=ru
     * @link http://help.yandex.com/webmaster/?id=1125296
     *
     * @var string
     */
    protected $queryParam;

    /**
     * Create a new method route.
     *
     * @param  string $with
     * @param  array  $defaults
     */
    public function __construct($with, array $defaults = array())
    {
        $this->queryParam = $with;
        $this->defaults = $defaults;
    }

    /**
     * factory(): defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::factory()
     * @param  array|Traversable $options
     * @return CrawlerIndexer
     * @throws Exception\InvalidArgumentException
     */
    public static function factory($options = array())
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new Exception\InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
        }

        if (!isset($options['queryParam'])) {
            throw new Exception\InvalidArgumentException('Missing "queryParam" in options array');
        }

        if (!isset($options['defaults'])) {
            $options['defaults'] = array();
        }

        return new static($options['queryParam'], $options['defaults']);
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
        if (!method_exists($request, 'getQuery')) {
            return null;
        }

        /* @var $query Parameters */
        $query = $request->getQuery();


        if ($query->get($this->queryParam, false) === false) {
            return null;
        }

        return new RouteMatch($this->defaults);
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
