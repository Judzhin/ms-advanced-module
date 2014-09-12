<?php

namespace ZendAdvancedModule\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use ZendAdvancedModule\Table;

class RouteTable {

    protected $tableGateway;

    /**
     * 
     * @param \Zend\Db\TableGateway\TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function(Select $select) {
            $select->join(array('pt' => Table::PAGE_TYPES), 'pt.id = pagetype_id');
        });
        return $resultSet;
    }

    /**
     * 
     * @return type
     */
    public function fetchBy($where) {
        $resultSet = $this->tableGateway->select(function(Select $select) use ($where) {
            $select->join(array('pt' => Table::PAGE_TYPES), 'pt.id = pagetype_id', array('namespace', 'controller', 'action'), Select::JOIN_LEFT);
            $select->where($where);
        });
        return $resultSet;
    }

    /**
     * 
     * @param type $id
     * @return type
     * @throws \Exception
     */
    public function getRoute($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * 
     * @param \ZendAdvancedModule\Model\Route $album
     * @throws \Exception
     */
    public function saveRoute(Route $album) {
        $data = array(
            'artist' => $album->artist,
            'title' => $album->title,
        );

        $id = (int) $album->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Route id does not exist');
            }
        }
    }

    /**
     * 
     * @param type $id
     */
    public function deleteRoute($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

}
