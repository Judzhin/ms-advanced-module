<?php

namespace ZendAdvancedModule\Model;

class PageType {

    protected $id;
    protected $name;
    protected $namespace;
    protected $controller;
    protected $action;

    /**
     * 
     * @param array $data
     */
    public function exchangeArray(array $data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->namespace = (!empty($data['namespace'])) ? $data['namespace'] : null;
        $this->controller = (!empty($data['controller'])) ? $data['controller'] : null;
        $this->action = (!empty($data['action'])) ? $data['action'] : null;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNamespace() {
        return $this->namespace;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setNamespace($namespace) {
        $this->namespace = $namespace;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setAction($action) {
        $this->action = $action;
    }

}
