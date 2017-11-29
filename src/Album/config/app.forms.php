<?php
namespace Album;

return [
    'plugins'  => [
        'forms' => [
            'album_form' => [
                'attributes' => [
                    'name' => 'album_form',
                    'id' => 'album_form',
                    'method' => 'POST',
                    'action' => '',
                ],
                'hydrator'  => 'Zend\Hydrator\ArraySerializable',
                'elements' => [
                    [
                        'spec' => [
                            'name' => 'album_id',
                            'type' => 'hidden',
                            'options' => [
                                'label' => 'tr_album_column_id',
                            ],
                            'attributes' => [
                                'id' => 'album_id',
                                'value' => '',
                                'placeholder' => 'tr_album_column_id',
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'spec' => [
                            'name' => 'album_title',
                            'type' => 'Text',
                            'options' => [
                                'label' => 'tr_album_column_title',
                            ],
                            'attributes' => [
                                'id' => 'album_title',
                                'value' => '',
                                'placeholder' => 'tr_album_column_title',
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'spec' => [
                            'name' => 'album_artist',
                            'type' => 'Text',
                            'options' => [
                                'label' => 'tr_album_column_artist',
                            ],
                            'attributes' => [
                                'id' => 'album_artist',
                                'value' => '',
                                'placeholder' => 'tr_album_column_artist',
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ]
        ]
    ]
];