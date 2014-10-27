<?php

/**
* deals with views
*/
class View
{
    static private $template;
    static public function render($viewName, array $data = array())
    {
        
        $viewName = str_replace('.', '/', $viewName);
        if (!file_exists(APP . 'views/' . $viewName . '.php')) {
            trigger_error('File ' . $viewName . '.php does not exist in ' . APP . 'views/' , E_USER_ERROR);
        }
        extract($data);

        ob_start();
            include APP . 'views/' . $viewName . '.php';
        $content = ob_get_clean();

        if (!empty(self::$template)) {
            self::$template = str_replace('@content', $content, self::$template);
            echo self::$template;
        } else {
            echo $content;
        }
        
    }

    static public function addTemplate($templateName, array $data = array())
    {
        $templateName = str_replace('.', '/', $templateName);
        if (!file_exists(APP . 'views/' . $templateName . '.php')) {
            trigger_error('File ' . $templateName . '.php does not exist in ' . APP . 'views/' , E_USER_ERROR);
        }
        extract($data);

        ob_start();
            include APP . 'views/' . $templateName . '.php';
        self::$template = ob_get_clean();
    }
}
