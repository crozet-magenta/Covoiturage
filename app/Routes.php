<?php
// Router::register('GET', ['url' => '/foo/{needed}/{?optional}', 'controller' => 'foo', 'action' => 'bar']);

Router::register('GET', ['url'        => '/Accueil',
                         'controller' => 'Main',
                         'action'     => 'home'
                ]);

Router::register('GET', ['url'        => '/',
                         'controller' => 'Main',
                         'action'     => 'home'
                ]);

Router::register('GET', ['url'        => '/Hello/{?name}',
                         'controller' => 'Test',
                         'action'     => 'hello'
                ]);

Router::fallback(['url'        => '/Accueil',
                  'controller' => 'Main',
                  'action'     => 'fallback'
                ]);