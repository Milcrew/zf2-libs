<?php
namespace Zf2Libs\Mvc\Router\Delegator;

use Zend\Mvc\Router\RoutePluginManager;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Delegator for RoutePluginManager
 */
class RoutePluginManagerDelegator implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        /* @var $routePluginManager RoutePluginManager */
        $routePluginManager = $callback();
        $routePluginManager->setInvokableClass('XRequestedWith', 'Zf2Libs\Mvc\Router\Http\XRequestedWith');
        return $routePluginManager;
    }
}
