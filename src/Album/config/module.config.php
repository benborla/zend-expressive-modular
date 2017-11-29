<?php
namespace Album;


use SessionMiddleware\Middleware\SessionMiddleware;

return [
    'routes' => [
        [
            'name'            => 'album',
            'path'            => '/album[/{action}[/{id:[0-9]+}]]',
            'middleware'      => [
                SessionMiddleware::class,
                Action\AlbumPage::class
            ],
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'album.rest',
            'path' => '/album/rest[/{action}[/{id:[0-9]+}]]',
            'middleware' => [
                SessionMiddleware::class,
                Action\AlbumPage::class
            ],
            'allowed_methods' => ['POST']
        ]
    ],

    'dependencies' => [
        'aliases' => [
            'translator' => \Zend\I18n\Translator\Translator::class,
        ],
        'invokables' => [

        ],
        'factories'  => [
            // Actions
            Action\AlbumPage::class       => Action\Factory\AlbumPageFactory::class,
            Action\AlbumRestPage::class   => Action\Factory\AlbumRestPageFactory::class,

            // Models
            Model\Table\AlbumTable::class => Model\Table\Factory\AlbumTableFactory::class,

            // Translator
            \Zend\I18n\Translator\Translator::class => \Zend\I18n\Translator\TranslatorServiceFactory::class,


        ],
    ],

    'templates' => [
        'paths' => [
            'album'       => [__DIR__ . '/../templates/album'],
            'albumError'  => [__DIR__ . '/../templates/error'],
            'albumLayout' => [__DIR__ . '/../templates/layout'],
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'MelisFieldCollection' => 'Album\Form\View\Helper\MelisFieldCollection',
            'MelisFieldRow'        => 'Album\Form\View\Helper\MelisFieldRow',
        ],
        'invokables' => [

        ],
        'factories' => [
            'Album\Form\View\Helper\MelisFieldCollection' => \Zend\ServiceManager\Factory\InvokableFactory::class,
            'Album\Form\View\Helper\MelisFieldRow'        => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ]
    ],

    'session' => [
        'config' => [
            'options' => [
                'name' => 'session_album',
            ],
        ],
        'validators' => [
            // requires zendframework/zend-session
            //\Zend\Session\Validator\RemoteAddr::class,
            //\Zend\Session\Validator\HttpUserAgent::class,
        ],
    ]
];