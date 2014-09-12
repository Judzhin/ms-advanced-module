<?php

namespace ZendAdvancedModule\ServiceManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendAdvancedModule\Model\Route;
use ZendAdvancedModule\Table;

/**
 * Description of RouteFactory
 *
 * @author judzhin
 */
class RouteTableGatewayFactory extends AbstractTableGatewayFactory implements FactoryInterface {

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \Zend\Db\TableGateway\TableGateway
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->createTableGataway($serviceLocator, new Route, Table::ROUTES);
    }

}
