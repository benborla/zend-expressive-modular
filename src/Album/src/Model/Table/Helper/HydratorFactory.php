<?php

namespace Album\Model\Table\Helper;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use RuntimeException;

/**
 * Class DbHydratorFactory
 * @package DbManager\Table\Helper
 */
class HydratorFactory
{
    /**
     * @var primary key of the table
     */
    protected $id;

    /**
     * @var TableGateway
     */
    protected $tableGateway;
    /**
     * @var Adapter
     */
    protected $dbAdapter;
    /**
     * DbHydratorFactory constructor.
     * @param TableGateway $tableGateway
     */
    protected function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway   = $tableGateway;
        $this->dbAdapter      = $this->tableGateway->getAdapter();
        $this->table          = $this->tableGateway->getTable();
        $this->tableColumns   = $this->tableGateway->getColumns();
    }
    /**
     * @return bool|string
     */
    protected function getCurrentDate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * @param $result
     * @param $model
     * @return HydratingResultSet
     */
    protected function hydrate($result, $model)
    {
        $resultSet = new HydratingResultSet( new ReflectionHydrator, $model );
        $resultSet->initialize($result);
        return $resultSet;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        return $resultSet;
    }

    public function getBy(array $where)
    {
        $rowSet = $this->tableGateway->select($where);

        return $rowSet;
    }

    public function getById($id)
    {
        $id = (int) $id;

        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo($this->id, $id);


       $resultSet = $this->tableGateway->selectWith($select);


        return $resultSet;
    }

    public function save($data, $id = null)
    {
        if(!$id) {
            $this->tableGateway->insert($data);

            return $this->tableGateway->lastInsertValue;
        }
        else {
            if(!$this->getById($id)) {
                throw new RuntimeException(sprintf(
                    'Cannot update with identifier %d; does not exist',
                    $id
                ));
            }

            $this->tableGateway->update($data, array($this->id => $id));

            return $id;
        }
    }

    public function deleteById($id)
    {
        $id = (int) $id;
        return $this->deleteByField($this->id, $id);
    }

    public function deleteByField($field, $value)
    {
        if($this->tableGateway->delete([$field => $value])) {
            return true;
        }
        else {
            return null;
        }
    }
}