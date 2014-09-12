<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendAdvancedModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class BlogController extends AbstractActionController {

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        die('Blog Index');
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function viewAction() {
        die('Blog View by id: ' . $this->getEvent()->getRouteMatch()->getParam('id'));
    }

}
