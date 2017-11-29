<?php
namespace Album\Action;

use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Album\Model\Table\AlbumTable;
abstract class AbstractAction
{
    protected $router;

    protected $template;

    protected $albumTable;

    protected $formElementManager;

    protected $config;

    protected $session;

    protected $translator;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        AlbumTable $albumTable,
        $config,
        $formElementManager,
        $translator,
        $session
    )
    {
        $this->router      = $router;
        $this->template    = $template;
        $this->albumTable  = $albumTable;
        $this->config      = $config;
        $this->translator  = $translator;
        $this->session     = $session;

        $this->formElementManager = $formElementManager;

    }

    public function getRouter()
    {
        return $this->router();
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getAlbumTable()
    {
        return $this->albumTable;
    }

    public function getFormElementManager()
    {
        return $this->formElementManager;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getTranslator()
    {
        return $this->translator;
    }
}