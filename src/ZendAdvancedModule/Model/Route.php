<?php

namespace ZendAdvancedModule\Model;

use Zend\Json\Json;
use Zend\Stdlib\ArrayUtils;

class Route {

    protected $id;
    protected $pagetypeId;
    protected $name;
    protected $type;
    protected $route;
    protected $verb;
    protected $regex;
    protected $spec;
    protected $scheme;
    protected $mayTerminate;
    protected $options;
    protected $pageType;

    /**
     * 
     */
    public function __construct() {
        $this->pageType = new PageType();
    }

    /**
     * 
     * @param array $data
     */
    public function exchangeArray(array $data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->pagetypeId = (!empty($data['pagetype_id'])) ? $data['pagetype_id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->route = (!empty($data['route'])) ? $data['route'] : null;
        $this->verb = (!empty($data['verb'])) ? $data['verb'] : null;
        $this->regex = (!empty($data['regex'])) ? $data['regex'] : null;
        $this->spec = (!empty($data['spec'])) ? $data['spec'] : null;
        $this->scheme = (!empty($data['scheme'])) ? $data['scheme'] : null;
        $this->mayTerminate = (!empty($data['may_terminate'])) ? $data['may_terminate'] : null;
        $this->options = (!empty($data['options'])) ? $data['options'] : null;

        $this->pageType->exchangeArray($data);
    }

    /**
     * 
     * @return type
     */
    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'pagetype_id' => $this->pagetypeId,
            'name' => $this->name,
            'type' => $this->type,
            'route' => $this->route,
            'may_terminate' => $this->mayTerminate,
            'options' => $this->options
        );
    }

    public function getId() {
        return $this->id;
    }

    public function getPagetypeId() {
        return $this->pagetypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getVerb() {
        return $this->verb;
    }

    public function getRegex() {
        return $this->regex;
    }

    public function getSpec() {
        return $this->spec;
    }

    public function getScheme() {
        return $this->scheme;
    }

    public function getMayTerminate() {
        return $this->mayTerminate;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPagetypeId($pagetypeId) {
        $this->pagetypeId = $pagetypeId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setRoute($route) {
        $this->route = $route;
    }

    public function setVerb($verb) {
        $this->verb = $verb;
    }

    public function setRegex($regex) {
        $this->regex = $regex;
    }

    public function setSpec($spec) {
        $this->spec = $spec;
    }

    public function setScheme($scheme) {
        $this->scheme = $scheme;
    }

    public function setMayTerminate($mayTerminate) {
        $this->mayTerminate = $mayTerminate;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    /**
     * 
     * @return type
     */
    public function toRouteStructure() {

        $arr = array(
            'type' => $this->getType()
        );

        $options = $this->getRouteOptions();

        if (!empty($options)) {
            $arr['options'] = $options;
        }

        $mayTerminate = (bool) $this->getMayTerminate();

        if (!empty($mayTerminate)) {
            $arr['may_terminate'] = $mayTerminate;
        }

        return $arr;
    }

    /**
     * 
     * @return type
     */
    protected function getRouteOptions() {

        $arr = array();

        $route = $this->getRoute();

        if (!empty($route)) {
            $arr['route'] = $route;
        }

        $verb = $this->getVerb();

        if (!empty($verb)) {
            $arr['verb'] = $verb;
        }

        $regex = $this->getRegex();

        if (!empty($regex)) {
            $arr['regex'] = $regex;
            $arr['spec'] = $this->getSpec();
        }

        $scheme = $this->getScheme();

        if (!empty($scheme)) {
            $arr['scheme'] = $scheme;
        }

        $defaults = $this->getRouteDefaults();

        if (!empty($defaults)) {
            $arr['defaults'] = $defaults;
        }

        $options = $this->getOptions();

        if (!empty($options) && is_string($options)) {
            $options = Json::decode($options, Json::TYPE_ARRAY);
        }

        if (is_array($options)) {
            $arr = ArrayUtils::merge($arr, $options);
        }

        return $arr;
    }

    /**
     * 
     * @return type
     */
    protected function getRouteDefaults() {

        $arr = array();

        $namespace = $this->pageType->getNamespace();

        if (!empty($namespace)) {
            $arr['__NAMESPACE__'] = $namespace;
        }

        $controller = $this->pageType->getController();

        if (!empty($controller)) {
            $arr['controller'] = $controller;
        }

        $action = $this->pageType->getAction();

        if (!empty($action)) {
            $arr['action'] = $action;
        }

        return $arr;
    }

}
