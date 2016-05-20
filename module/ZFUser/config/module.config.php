<?php

namespace ZFUser;

return array(
    'router' => array(
        'routes' => array(
            'zfuser-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZFUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register',
                    )
                )
            ),
            'zfuser-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'ZFUser\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            'zfuser-auth' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZFUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'zfuser-logout' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZFUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            
            'zfuser-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZFUser\Controller',
                        'controller' => 'Users',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'ZFUser\Controller',
                                'controller' => 'users'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'ZFUser\Controller',
                                'controller' => 'users'
                            )
                        )
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'ZFUser\Controller\Index' => 'ZFUser\Controller\IndexController',
            'ZFUser\Controller\Users' => 'ZFUser\Controller\UsersController',
            'ZFUser\Controller\Auth' => 'ZFUser\Controller\AuthController',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
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
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'ZFUser_fixture' => __DIR__ . '/../src/ZFUser/Fixture',
    ),
);