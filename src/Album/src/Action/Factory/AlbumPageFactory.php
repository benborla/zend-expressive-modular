<?php

namespace Album\Action\Factory;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Album\Model\Table\AlbumTable;
use Album\Action\AlbumPage;
use Zend\Session\Container;
class AlbumPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $albumTable = $container->get(AlbumTable::class);

        $config = $container->get('config');

        $formElementManager = $container->get('FormElementManager');

        $translator = $container->get('translator');

        $translator->addTranslationFile('phparray', __DIR__ . '/../../../language/en_EN.php');

        $session = new Container('album');

        return new AlbumPage($router, $template, $albumTable, $config, $formElementManager, $translator, $session);
    }
}
