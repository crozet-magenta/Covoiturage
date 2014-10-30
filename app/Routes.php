<?php
// Router::register('GET', ['url' => '/foo/{needed}/{?optional}', 'controller' => 'foo', 'action' => 'bar']);

/*===================================
=            Home routes            =
===================================*/

Router::register('GET', ['url'        => '/',
                         'controller' => 'MainController',
                         'action'     => 'home'
                ]);
/*-----  End of Home routes  ------*/



/*===================================
=            User routes            =
===================================*/

Router::register('GET', ['url'         => '/Register',
                          'controller' => 'UserController',
                          'action'     => 'register'
                ]);

Router::register('POST', ['url'        => '/Register',
                          'controller' => 'UserController',
                          'action'     => 'store'
                ]);

Router::register('GET', ['url'         => '/Register/Success',
                          'controller' => 'UserController',
                          'action'     => 'afterStore'
                ]);

Router::register('GET', ['url'         => '/Validate/{code}',
                          'controller' => 'UserController',
                          'action'     => 'validate'
                ]);

Router::register('GET', ['url'         => '/Login',
                          'controller' => 'UserController',
                          'action'     => 'login'
                ]);

Router::register('POST', ['url'        => '/Login',
                          'controller' => 'UserController',
                          'action'     => 'loginCheck'
                ]);

Router::register('GET', ['url'         => '/ResetPassword',
                          'controller' => 'UserController',
                          'action'     => 'resetPassword'
                ]);
/*-----  End of User routes  ------*/



/*=====================================
=            search routes            =
=====================================*/

Router::register('POST', ['url'        => '/search/{start}/{end}/{date}',
                          'controller' => 'SearchController',
                          'action'     => 'search'
                ]);

Router::register('GET', ['url'         => '/search/{start}/{end}/{date}',
                          'controller' => 'SearchController',
                          'action'     => 'search'
                ]);
/*-----  End of search routes  ------*/



/*====================================
=            Other routes            =
====================================*/

Router::register('GET', ['url'        => '/autocomplete',
                         'controller' => 'ToolsController',
                         'action'     => 'autocomplete'
                ]);

Router::fallback(['controller' => 'MainController',
                  'action'     => 'fallback'
                ]);
/*-----  End of Other routes  ------*/

