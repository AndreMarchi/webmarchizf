<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'ZFUserRest\Controller\UserRest' => 'ZFUserRest\Controller\UserRestController'
        )
    ),
    'router' => array(
        'routes' => array(
            'zfuser-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/user[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'ZFUserRest\Controller\UserRest'
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'ZFUser' . '\Entity' => 'ZFUser' . '_driver'
                ),
            ),
        ),
    ),
);