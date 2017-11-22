<?php

namespace Album\Action\Factory;

use Interop\Container\ContainerInterface;
use Album\Model\Table\AlbumTable;
use Album\Action\AlbumRestPage;
class AlbumRestPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $albumTable = $container->get(AlbumTable::class);

        return new AlbumRestPage($albumTable);
    }
}
