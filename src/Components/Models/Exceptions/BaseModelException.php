<?php
declare(strict_types=1);

namespace App\Components\Models\Exceptions;

/**
 * Class BaseModelException
 * @package App\Components\Models\Exceptions
 */
class BaseModelException extends BaseException
{
    /**
     * BaseModelException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
