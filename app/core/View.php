<?php

/**
* deals with views
*/
class View
{
    /**
     * @var string HTML content of the loaded template template
     */
    static private $template;

    /**
     * renders a view with the loaded template if any and echos the result
     *
     * @param string $viewName name of the view to render
     * @param array  $data     vars to pass to the view
     */
    static public function render($viewName, array $data = [])
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

    /**
     * renders a template and stores the result in $template
     *
     * @param string $templateName name of the template to render
     * @param array  $data         vars to pass to the view
     */
    static public function addTemplate($templateName, array $data = [])
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
