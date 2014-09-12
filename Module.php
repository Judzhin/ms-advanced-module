<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendAdvancedModule;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use ZendAdvancedModule\Mvc\Router\Http\Database;

class Module {

    /**
     * 
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $serviceManager = $e->getApplication()->getServiceManager();
        $routeTable = $serviceManager->get('ZendAdvancedModule\Model\RouteTable');
        
        //echo "<pre>";
        //print_r(Database::factory($routeTable));
        //die();
        
        $e->getRouter()->addRoutes(Database::factory($routeTable));
    }

    /**
     * 
     * @return type
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return type
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * 
     * @return type
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'ZendAdvancedModule\Model\RouteTable' => 'ZendAdvancedModule\ServiceManager\RouteTableFactory',
                'RouteTableGatewayFactory' => 'ZendAdvancedModule\ServiceManager\RouteTableGatewayFactory',
            ),
        );
    }

}
