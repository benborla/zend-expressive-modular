<?php
namespace Album\Model\Table\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Album\Model\Table\AlbumTable;
use Zend\Hydrator\ObjectProperty;
use Album\Model\Album;
class AlbumTableFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $dbAdapter          = $container->get( AdapterInterface::class );
        $hydratingResultSet = new HydratingResultSet(new ObjectProperty(), new Album());
        $tableGateway       = new TableGateway('album', $dbAdapter, null, $hydratingResultSet);

        return new AlbumTable($tableGateway);
    }
}