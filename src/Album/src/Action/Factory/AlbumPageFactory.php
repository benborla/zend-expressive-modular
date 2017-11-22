<?php

namespace Album\Action\Factory;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Album\Model\Table\AlbumTable;
use Album\Action\AlbumPage;
class AlbumPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        $albumTable = $container->get(AlbumTable::class);

        return new AlbumPage($router, $template, $albumTable);
    }
}
