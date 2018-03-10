<?php
namespace Core;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {

        if (error_reporting() !== 0) { //to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler ($exception) {

        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        if (\App\Config::SHOW_ERRORS) {
            echo '<h1>Fatal Error</h1>';
            echo "<p>Uncaught exception: '".get_class($exception)."'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";

        }
        else {
//            View::render("$code.html");
            if ($code == 404) {
                echo "<h1>Page not found</h1>";
            }
            else {

                echo "<h1>An error occured</h1>";
            }
        }
    }
}