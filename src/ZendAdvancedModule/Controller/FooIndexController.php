<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendAdvancedModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FooIndexController extends AbstractActionController {

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        return new ViewModel();
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function formSubmitAction() {
        die('form submit');
    }

}
