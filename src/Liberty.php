<?php
namespace Liberty;

use Cake\Utility\Inflector;
use Cake\View\ViewBuilder;
use InvalidArgumentException;

class Liberty
{
    /**
     * get the result of rendering
     *
     * @access public
     * @author kozo
     * @author ito
     */
    public static function __callStatic ($name, $arguments)
    {
        if (count($arguments) == 0) {
            throw new InvalidArgumentException();
        }
        if (!is_string($arguments[0]) || (isset($arguments[1]) && !is_array($arguments[1]))) {
            throw new InvalidArgumentException();
        }

        $fileName = $arguments[0];
        $params = isset($arguments[1]) ? $arguments[1] : [];

        $builder = new ViewBuilder();
        $view = $builder
            ->className('Cake\View\View')
            ->templatePath(Inflector::camelize($name))
            ->layout(false)
            ->build();

        $view->_ext = '.' . $name;
        $view->viewVars = $params;

        return $view->render($fileName);
    }
}

