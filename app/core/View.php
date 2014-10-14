<?php

/**
* deals with views
*/
class View
{
    static private $template;
    static public function render($name, array $data = array())
    {
        
        $name = str_replace('.', '/', $name);
        if (!file_exists(APP . 'views/' . $name . '.php')) {
            trigger_error('File ' . $name . '.php does not exist in ' . APP . 'views/' , E_USER_ERROR);
        }
        extract($data);

        ob_start();
            include APP . 'views/' . $name . '.php';
        $content = ob_get_clean();

        if (!empty(self::$template)) {
            self::$template = str_replace('@content', $content, self::$template);
            echo self::$template;
        } else {
            echo $content;
        }
        
    }

    static public function addTemplate($name, array $data = array())
    {
        $name = str_replace('.', '/', $name);
        if (!file_exists(APP . 'views/' . $name . '.php')) {
            trigger_error('File ' . $name . '.php does not exist in ' . APP . 'views/' , E_USER_ERROR);
        }
        extract($data);

        ob_start();
            include APP . 'views/' . $name . '.php';
        self::$template = ob_get_clean();
    }
}
