<?php

namespace ZendAdvancedModule\ServiceManager;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 * Description of RouteFactory
 *
 * @author judzhin
 */
abstract class AbstractTableGatewayFactory {

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param ArrayObject $arrayObjectPrototype
     * @param string $table
     * @return \Zend\Db\TableGateway\TableGateway
     */
    protected function createTableGataway(ServiceLocatorInterface $serviceLocator, $arrayObjectPrototype, $table) {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($arrayObjectPrototype);
        return new TableGateway($table, $adapter, null, $resultSetPrototype);
    }

}
