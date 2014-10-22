<?php
// Router::register('GET', ['url' => '/foo/{needed}/{?optional}', 'controller' => 'foo', 'action' => 'bar']);

Router::register('GET', ['url'        => '/',
                         'controller' => 'MainController',
                         'action'     => 'home'
                ]);

Router::register('GET', ['url'        => '/autocomplete',
                         'controller' => 'ToolsController',
                         'action'     => 'autocomplete'
                ]);

Router::register('POST', ['url'        => '/search/{start}/{end}/{date}',
                          'controller' => 'SearchController',
                          'action'     => 'search'
                ]);

Router::register('GET', ['url'        => '/search/{start}/{end}/{date}',
                          'controller' => 'SearchController',
                          'action'     => 'search'
                ]);


Router::fallback(['controller' => 'MainController',
                  'action'     => 'fallback'
                ]);