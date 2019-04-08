<?php

declare(strict_types=1);

namespace App\Components\Base;

/**
 * Class Error
 *
 * @package App\Components\Base
 */
class Error
{
    /**
     * Exception handler
     *
     * @param \Exception $exception The exception
     */
    public static function exceptionHandler($exception): void
    {
        $log = ROOT . '/logs/' . date('d-m-Y') . '.txt';

        ini_set('error_log', $log);

        $message = "Uncaught exception: '" . get_class($exception) . "'" . PHP_EOL;
        $message .= "Message: '" . $exception->getMessage() . "'" . PHP_EOL;
        $message .= 'Stack trace: ' . PHP_EOL . $exception->getTraceAsString() . PHP_EOL;
        $message .= "Thrown in '" . $exception->getFile() . "' on line " .
            $exception->getLine() . PHP_EOL;

        error_log($message);
    }
}
