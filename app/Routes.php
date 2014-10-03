<?php
// Router::register('GET', ['url' => '/foo/{needed}/{?optional}', 'controller' => 'foo', 'action' => 'bar']);

Router::register('GET', ['url'        => '/Accueil',
                         'controller' => 'Main',
                         'action'     => 'home'
                ]);

Router::fallback(['url'        => '/Accueil',
                  'controller' => 'Main',
                  'action'     => 'fallback'
                ]);