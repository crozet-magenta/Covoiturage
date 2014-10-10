<?php

/**
* deals with views
*/
class View
{
    static private $content;
    static private $template;
    static private $data;

    static public function render($name, array $data = array())
    {
        
        $name = str_replace('.', '/', $name);
        if (!file_exists(APP . 'views/' . $name . 'View.php')) {
            trigger_error('File ' . $name . 'View.php does not exist in ' . APP . 'views/' , E_USER_ERROR);
        }
        self::$content = file_get_contents(APP . 'views/' . $name . 'View.php');
        self::$data = $data;

        self::parse();
    }

    static public function parse()
    {
        preg_match("/@section\('(.*)'\)(.*)@stop/s", self::$content, $out);
        var_dump($out);
    }
}
