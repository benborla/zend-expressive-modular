<?php
namespace Album\Model\Table;

use Album\Model\Table\Helper\HydratorFactory;
use Zend\Db\TableGateway\TableGateway;

class AlbumTable extends HydratorFactory
{
    public function __construct(TableGateway $tableGateway)
    {
        parent::__construct($tableGateway);
        $this->id = 'album_id';
    }
}