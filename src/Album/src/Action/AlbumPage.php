<?php
namespace Album\Action;

use Fig\Http\Message\StatusCodeInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Album\Model\Table\AlbumTable;
class AlbumPage implements ServerMiddlewareInterface
{
    private $router;

    private $template;

    private $albumTable;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, AlbumTable $albumTable)
    {
        $this->router     = $router;
        $this->template   = $template;
        $this->albumTable = $albumTable;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $action = $request->getAttribute('action', 'index') . 'Action';

        if (! method_exists($this, $action)) {
            return new EmptyResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        return $this->$action($request, $delegate);
    }

    public function indexAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $albums = $this->albumTable->fetchAll();

        return new HtmlResponse($this->template->render('album::album-page', ['albums' => $albums]));
    }

    public function addAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->albumTable->save([
            'album_title' => 'tester updated',
            'album_artist' => 'borla'
        ], 151);
            return new HtmlResponse($this->template->render('album::album-page-add'));

    }

    public function editAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id', false);
        if (! $id) {
            throw new \InvalidArgumentException('id parameter must be provided');
        }

        return new HtmlResponse(
            $this->template->render('album::album-page-edit', ['id' => $id])
        );
    }

    public function viewAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id', false);
        if (! $id) {
            throw new \InvalidArgumentException('id parameter must be provided');
        }

        $album = $this->albumTable->getById($id)->current();

        return new HtmlResponse(
            $this->template->render('album::album-page-view', ['album' => $album])
        );
    }
}