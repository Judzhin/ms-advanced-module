<?php

namespace ZendAdvancedModule\Mvc\Router\Http;

use ZendAdvancedModule\Model\RouteTable;
use ZendAdvancedModule\Model\Route;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author judzhin
 */
class Database {

    /**
     * 
     * @param \ZendAdvancedModule\Model\RouteTable $routeTable
     * @param type $parentId
     * @return type
     */
    public static function factory(RouteTable $routeTable, $parentId = null) {
        $routes = array();
        foreach ($routeTable->fetchBy(array('parent_id' => $parentId)) as $row) {
            $routeName = $row->getName();
            $routes[$routeName] = $row->toRouteStructure();

            $childRoutes = static::factory($routeTable, $row->getId());
            if (count($childRoutes)) {
                $routes[$routeName]['child_routes'] = $childRoutes;
            }
        }
        return $routes;
    }

}
