<?php
namespace Core;

class View
{
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; //relative to Core directory

        if (is_readable($file)) {
            require $file;
        }
        else
        {
//            echo '$file not found';
            throw new \Exception("$file not found");

        }
    }
}