<?php

declare(strict_types=1);

namespace App\Components\Models\Exceptions;

/**
 * Class ModelException
 *
 * @package App\Components\Base\Exceptions
 */
class ModelException extends \Exception
{
    /**
     * ModelException constructor.
     *
     * @param $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
