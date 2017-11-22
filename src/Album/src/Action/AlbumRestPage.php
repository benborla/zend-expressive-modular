<?php
namespace Album\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Album\Model\Table\AlbumTable;
class AlbumRestPage implements ServerMiddlewareInterface
{

    private $albumTable;

    public function __construct(AlbumTable $albumTable)
    {
        $this->albumTable = $albumTable;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $action = $request->getAttribute('action', 'index') . 'Action';

        if (! method_exists($this, $action)) {
            return new JsonResponse(['error' => 'true', 'message' => 'URL not found'], 404);
        }

        return $this->$action($request, $delegate);
    }

    public function getAlbumAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $success  = 0;
        $message  = 'Reached';
        $data     = [];
        $response = [];

        if($request->getMethod() == 'POST') {

            $post = $request->getParsedBody();
            $id   = (int) $post['id'] ?: false;
            $data = (array) $this->albumTable->getById($id)->current();

            if($data) {
                $success = 1;
            }

            $response = [
                'success' => $success,
                'message' => $message,
                'data'    => $data
            ];
        }

        return new JsonResponse($response);
    }

    public function checkAction(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $success  = 1;
        $message  = 'Reached';
        $data     = [];
        $response = [];

        if($request->getMethod() == 'POST') {

            $data = $this->albumTable->fetchAll()->toArray();

            $response = [
                'success' => $success,
                'message' => $message,
                'data'    => $data
            ];
        }

        return new JsonResponse($response);
    }

}