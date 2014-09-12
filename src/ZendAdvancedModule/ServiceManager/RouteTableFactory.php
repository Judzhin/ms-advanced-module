<?php

namespace ZendAdvancedModule\ServiceManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendAdvancedModule\Model\RouteTable;

/**
 * Description of RouteFactory
 *
 * @author judzhin
 */
class RouteTableFactory implements FactoryInterface {

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \ZendAdvancedModule\Model\RouteTable
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $tableGateway = $serviceLocator->get('RouteTableGatewayFactory');
        $table = new RouteTable($tableGateway);
        return $table;
    }

}
