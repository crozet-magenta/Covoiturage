<?php
// Router::register('GET', ['url' => '/foo/{needed}/{?optional}', 'controller' => 'foo', 'action' => 'bar']);

Router::register('GET', ['url'        => '/Accueil',
                         'controller' => 'Main',
                         'action'     => 'home'
                ]);