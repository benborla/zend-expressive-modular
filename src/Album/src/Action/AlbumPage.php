<?php
namespace Album\Action;

use Fig\Http\Message\StatusCodeInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Album\Action\AbstractAction;
class AlbumPage extends AbstractAction implements ServerMiddlewareInterface
{

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


        $text = $this->getSession()->look_for_me = "Borla";

        $locale = null;

        $albums = $this->getAlbumTable()->fetchAll();

        $text = $this->getTranslator()->translate("hello");

        return new HtmlResponse($this->template->render('album::album-page', [
            'albums' => $albums,
            'config' => $this->config,
            'text' => $text,
            'locale' => $locale
        ]));
    }

    public function addAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $this->getAlbumTable()->save([
            'album_title' => 'tester updated',
            'album_artist' => 'borla'
        ], 151);
            return new HtmlResponse($this->template->render('album::album-page-add',[
                'form' => $this->albumForm(),
                'name' => $this->session->look_for_me
            ]));

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

        $album = $this->getAlbumTable()->getById($id)->current();

        return new HtmlResponse(
            $this->template->render('album::album-page-view', ['album' => $album])
        );
    }

    private function albumForm()
    {
        $formConfig = $this->config['plugins']['forms']['album_form'];
        $formFactory = new \Zend\Form\Factory();
        $formFactory->setFormElementManager($this->getFormElementManager());

        $form = $formFactory->createForm($formConfig);

        return $form;
    }


}